<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company as Companies;
use App\Models\Categories;
use App\Models\Projects;

class AddTask extends Component
{
    public $companyId = null; 
    public $selectedCompany = null;
    public $tasks = null;
    public $currentUrl;

    public $company_name, $address, $email, $phone, $owner_id, $selected_id,$category_id;
    public $contact_person = null;

    protected $rules = [
        'company_name' => 'required|min:2',
        'email' => 'required|email',
    ];


    public function render()
    {
       
        $companies =  Companies::where('owner_id', auth()->user()->owner_id)->get();
        $categories =  Categories::all();
        $projects =  Projects::all();

        return view('livewire.add-task',['categories' => $categories,
            'companies' => $companies,
            'projects' => $projects]);
    }

    public function showModal()
    {
        $this->showEditModal = false;
        $this->resetInput();
        $this->dispatchBrowserEvent('show-modal');
    }

    public function showModalCategory()
    {
      
        $this->dispatchBrowserEvent('show-modal-category');
    }

    public function resetInput()
    {
        $this->company_name = '';
        $this->address = '';
        $this->contact_person = '';
        $this->email = '';
        $this->phone = '';
    }

    public function saveCompany()
    {
        $validatedData = $this->validate();

        Companies::create([
            'company_name' => $this->company_name,
            'email' => $this->email,
            'contact_person' => $this->contact_person,
            'phone' => $this->phone,
            'address' => $this->address,
            'owner_id' => auth()->user()->owner_id,

        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('success', [
            'title' => 'New Company Created!',
            'icon' => 'success',
            'iconColor' => 'green'
        ]);
        return redirect()->to('/add-task');
    }



    public function closeModal()
    {
        $this->resetInput();
    }

    public function saveCategory()
    {
      //  $validatedData = $this->validate();

        Categories::create([
            'stage_name' => $this->category_id
        ]);


        $this->dispatchBrowserEvent('close-modal-category');
        $this->dispatchBrowserEvent('success', [
            'title' => 'New Category Created!',
            'icon' => 'success',
            'iconColor' => 'green'
        ]);
    }

 


    public function selectedCompany()
    {
        // $this->selectedCompany =Companies::where('id', $company_id)->get();
        $post = Companies::find($this->companyID);
        $this->selectedCompany = $post; 
       
    }
    public function mount()
    {
        $this->currentUrl = url()->current();
    }
}
