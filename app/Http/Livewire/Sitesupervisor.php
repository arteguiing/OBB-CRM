<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Company as Companies;
use App\Models\Categories;
use App\Models\Projects;
use App\Models\Task;
use App\Models\Notes;
use App\Models\SiteSupervisor as Supervisor;
use DB;
use Validator;

class Sitesupervisor extends Component
{
    //public $t_id, $contact_person, $project_id, $company_id, $address, $category_id, $send_date, $due_date, $received_date;
    public $selectedCategory = '';
    public $categories = '';
    public $companylist = '';
    public $projects = '';
    public $noteslist = [];
    public $noteId = '';
    public $note = '';
    public $notesCount = '';

    public $t_id,$owner_id,$stage_id,$task_name,$duration,$start_date,$end_date;
    public $order_status = '';
    public $lastTaskId ="";

    protected $listeners = ['deleteConfirmed' => 'deleteCompany'];
    public $taskID = null;

    public $showEditModal = false;

    protected $rules = [
        'stage_id' => 'required',
        'task_name' => 'required',
        'order_status' => 'required',
        'start_date' => 'required',
    ];
    

    // protected $rules = [
    //         'note' => 'required|min:2',
    //     ];

    public function addTask()
    {
        $validatedData = $this->validate();
       
        Supervisor::create([
            'stage_id' => $this->stage_id,
            'task_name' => $this->task_name,
            'order_status' => $this->order_status,
            'duration' => $this->duration,
            'owner_id' =>  auth()->user()->owner_id,
            'sort_id' => $this->lastTaskId + 1,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,


        ]);

        $this->resetTaskInput();
        $this->dispatchBrowserEvent('load-progress');
        $this->dispatchBrowserEvent('close-task-modal');


        $this->dispatchBrowserEvent('success', [
            'title' => 'New Task  Added!',
            'icon' => 'success',
            'iconColor' => 'green'
        ]);
    }

    public function resetTaskInput()
    {
            $this->stage_id = '';
            $this->task_name = '';
            $this->order_status = '';
            $this->start_date = '';
            $this->end_date = '';
    }

    public function showModal()
    {
        $this->showEditModal = false;
        $this->resetTaskInput();
        $this->dispatchBrowserEvent('show-task-modal');
    }

    public function closeModal()
    {
        $this->resetErrorBag();
        $this->resetTaskInput();
        $this->dispatchBrowserEvent('close-task-modal');

    }

    public function confirmDelete($id)
    {
        $this->taskID = $id;
        $this->dispatchBrowserEvent('delete');
    }

    public function deleteCompany()
    {
        $record = Supervisor::where('id', $this->taskID);
        $record->delete();

        $this->dispatchBrowserEvent('deleted');
    }




    public function render()
    {
        $catId =  $this->selectedCategory;

        $data = DB::table('site_supervisor')
            ->select('site_supervisor.id', 'site_supervisor.stage_id','site_supervisor.order_status', 'site_supervisor.task_name', 'site_supervisor.start_date', 'site_supervisor.end_date', 'stages.stage_name', 'site_supervisor.sort_id')
            ->leftJoin('stages', 'site_supervisor.stage_id', '=', 'stages.id')
            ->where("site_supervisor.owner_id", auth()->user()->owner_id)
            ->when(!empty($catId), function ($query) use ($catId) {
                return $query->where('stage_id', $catId);
            })
            ->orderBy('site_supervisor.sort_id', 'asc')
            ->get();

        $tasks = [];

        foreach ($data as $item) {
            $tasks[$item->stage_name][] = $item;
        }
        return view('livewire.sitesupervisor', ['tasks' => $tasks]);
    }

    public function updateTaskOrder($list)
    {
        foreach ($list as $item) {
            Supervisor::where('id',
                $item['value']
            )
            ->update(['sort_id' => $item['order']]);
        }

        
    }

    public function mount()
    {
        $this->categories = Categories::all();
        $this->companylist = Companies::where('owner_id', auth()->user()->owner_id)->get();
        $this->lastTaskId = Supervisor::where('owner_id', auth()->user()->owner_id)->max('sort_id');

        $this->projects  =  Projects::all();

        $this->notesCount = DB::table('notes')
            ->select('task_id', DB::raw('count(*) as total'))
            ->groupBy('task_id')
            ->get();
    }

    public function editTask($id)
    {
        $this->showEditModal = true;
        
        $this->dispatchBrowserEvent('show-task-modal');
        $this->resetTaskInput();
        $this->t_id = $id;

        $task = Supervisor::where('id', $id)->first();
       
        $this->stage_id = $task->stage_id;
        $this->task_name = $task->task_name;
        $this->order_status = $task->order_status;
        $this->duration = $task->duration;
        $this->start_date = $task->start_date;
        $this->end_date = $task->end_date;
    }

    public function updateTask()
    {
         $validatedData = $this->validate();

        $record = Supervisor::find($this->t_id);
        $record->update([
            'stage_id' => $this->stage_id,
            'task_name' => $this->task_name,
            'order_status' => $this->order_status,
            'duration' => $this->duration,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ]);

        $this->resetTaskInput();
        $this->dispatchBrowserEvent('close-task-modal');
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

        $this->validate([
            'note' => 'required|min:3',
        ]);

            Notes::create([
                'note' => $this->note,
                'task_id' => $this->t_id,
            ]);

            $this->resetNoteInput();
            $this->viewNotes($this->t_id);

            $this->dispatchBrowserEvent('success', [
                'title' => 'New Note  Added!',
                'icon' => 'success',
                'iconColor' => 'green'
            ]);
        
        
    


      
    }

    public function resetNoteInput()
    {
        $this->note = '';
    }

    public function deleteNote($id)
    {
        $record = Notes::where('id', $id);
        $record->delete();

        $this->viewNotes($this->t_id);

        //$this->dispatchBrowserEvent('close-modal-notes');
    }

  

    





  

  

  
}
