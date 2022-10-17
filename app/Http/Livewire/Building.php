<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Company as Companies;
use App\Models\Categories;
use App\Models\Projects;
use App\Models\Task;
use App\Models\Notes;
use DB;

class Building extends Component
{
    public $t_id,$task_name, $contact_person,$company_id,$address,$category_id,$send_date,$due_date, $received_date;
    public $selectedCategory = '';
    public $categories = '';
    public $companylist = '';
    public $projects = '';
    public $noteslist = [];
    public $noteId = '';
    public $note ='';
    public $notesCount ='';
    public $project_id = '';

    protected $rules = [
        'note' => 'required|min:2',
    ];

    public function render()
    {
      
        $catId =  $this->selectedCategory;
        
        $data = DB::table('tasks')
            ->select('tasks.id', 'tasks.category_id', 'tasks.task_name', 'tasks.send_date', 'tasks.due_date', 'stages.stage_name','tasks.sort_id')
            ->leftJoin('stages', 'tasks.category_id', '=', 'stages.id')
            ->where("tasks.owner_id", auth()->user()->owner_id)
            ->when(!empty($catId), function ($query) use ($catId) {
                return $query->where('category_id', $catId);
            })
            ->orderBy('tasks.sort_id', 'asc')
            ->get();

        $tasks = [];

        foreach ($data as $item) {
            $tasks[$item->stage_name][] = $item;
        }
            
       
      return view('livewire.building',['tasks' => $tasks]);
    }

    public function mount()
    {
         $this->categories = Categories::all();
         $this->companylist = Companies::where('owner_id', auth()->user()->owner_id)->get();

        $this->projects  =  Projects::all();

        $this->notesCount = DB::table('notes')
        ->select('task_id', DB::raw('count(*) as total'))
        ->groupBy('task_id')
        ->get();

    }

    public function editTask($id)
    {
        // $this->showEditModal = true;
        // $this->resetValidation();
        $this->dispatchBrowserEvent('show-modal');
        $this->resetInput();
        $this->t_id = $id;
        $task = Task::where('id', $id)->first();
      
        $this->task_name = $task->task_name;
        $this->project_id = $task->project_id;
        $this->category_id = $task->category_id;
        $this->company_id = $task->company_id;
        $this->phone = $task->phone;
        $this->contact_person = $task->contact_person;
        $this->send_date = $task->send_date;
        $this->due_date = $task->due_date;
        $this->received_date = $task->received_date;
   
    }

    public function updateTask()
    {
       // $validatedData = $this->validate();

        $record = Task::find($this->t_id);
        $record->update([
            'task_name' => $this->task_name,
            'contact_person' => $this->contact_person,
            'phone' => $this->phone,
            'category_id' => $this->category_id,
            'company_id' => $this->company_id,
            'project_id' => $this->project_id,
            'send_date' => $this->send_date,
            'start' => $this->send_date .'T00:00:00',
            'due_date' => $this->due_date,
            'received_date' => $this->received_date,
           
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('success', [
            'title' => 'Task Updated!',
            'icon' => 'success',
            'iconColor' => '#a3e635'
        ]);
    }

    public function viewNotes($id)
    {
        $this->dispatchBrowserEvent('show-notes-modal');
        
        $this->noteslist = Notes::where('task_id', $id)->get();
        $this->t_id = $id;
    }

    public function addNote()
    {
        $validatedData = $this->validate();

        Notes::create([
            'note' => $this->note,
            'task_id' => $this->t_id,
        ]);

        $this->resetNoteInput();
        $this->viewNotes($this->t_id);
        //$this->dispatchBrowserEvent('close-modal-notes');

        $this->dispatchBrowserEvent('success', [
            'title' => 'New Note  Added!',
            'icon' => 'success',
            'iconColor' => 'green'
        ]);
    }

    public function deleteNote($id)
    {
        $record = Notes::where('id', $id);
        $record->delete();

        $this->viewNotes($this->t_id);

        //$this->dispatchBrowserEvent('close-modal-notes');
    }

    public function resetNoteInput()
    {
        $this->note = '';
    }

    public function showModal()
    {
       // $this->showEditModal = false;
        //$this->resetInput();
        $this->dispatchBrowserEvent('show-modal');
    }

    

    public function closeModal()
    {
        $this->resetInput();
    }
   
    public function resetInput()
    {
        $this->company_name = '';
        $this->address = '';
        $this->contact_person = '';
        $this->email = '';
        $this->phone = '';
    }

    public function updateTaskOrder($list)
    {
        foreach ($list as $item) {
            Task::where('id', $item['value'])
            ->update(['sort_id' => $item['order']]);
        }

        //$this->tasks = Task::orderBy('order')->get();
    }


   
}
