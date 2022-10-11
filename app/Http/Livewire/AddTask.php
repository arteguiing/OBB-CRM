<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company as Companies;

class AddTask extends Component
{
    public $companyId = null; 
    public $companies = null;
    public $selectedCompany = null;
    public $tasks = null;

    public $company_name, $address, $email, $phone, $owner_id, $selected_id;
    public $contact_person = null;

    protected $rules = [
        'company_name' => 'required|min:2',
        'email' => 'required|email',
    ];


    public function render()
    {
        return view('livewire.add-task');
    }

    public function showModal()
    {
        $this->showEditModal = false;
        $this->resetInput();
        $this->dispatchBrowserEvent('show-modal');
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

    public function mount(){

         $this->companies = Companies::all();
      
    }


    public function selectedCompany()
    {
        // $this->selectedCompany =Companies::where('id', $company_id)->get();
        $post = Companies::find($this->companyID);
        $this->selectedCompany = $post;
       
    }
}
