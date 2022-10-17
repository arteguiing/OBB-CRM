<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company as Companies;
//use Dotenv\Validator;
use Illuminate\Support\Facades\Validator;

class Company extends Component
{

   public $company_name, $address, $contact_person, $email, $phone, $owner_id, $selected_id;
   public $updateMode = false;

   public $notificationMessage  = false;
   public $updateNotification  = false;
   public $showEditModal = false;

   protected $listeners = ['deleteConfirmed' => 'deleteCompany'];
   public $companyID = null;
   

    protected $rules = [
        'company_name' => 'required|min:2',
        'email' => 'required|email',
    ];

    public function confirmDelete($id)
    {
        $this->companyID = $id;
        $this->dispatchBrowserEvent('delete');
        
    }

    public function deleteCompany(){
        $record = Companies::where('id', $this->companyID);
        $record->delete();

        $this->dispatchBrowserEvent('deleted');
    }

    public function render()
    {
        $companies = Companies::where('owner_id', '=',auth()->user()->id)->orderBy('id', 'ASC')->paginate(10);
        
        return view('livewire.company', [
            'companies'=> $companies,
        ]);
    }

    public function updated($fields){
        $this->validateOnly($fields);
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

    public function resetState(){

    }

    public function showModal(){
        $this->showEditModal = false;
        $this->resetInput();
        $this->dispatchBrowserEvent('show-modal');
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
        $this->dispatchBrowserEvent('success',[
            'title' => 'New Company Created!',
            'icon' => 'success',
            'iconColor' => 'green'
        ]);
        
    }

    public function editCompany(Companies $company)
    {
       
        $this->showEditModal = true;
        $this->resetValidation();
        $this->dispatchBrowserEvent('show-modal');

             $this->company_id = $company->id;
             $this->company_name = $company->company_name;
             $this->contact_person = $company->contact_person;
             $this->phone = $company->phone;
             $this->email = $company->email;
             $this->address = $company->address;
        
      
    }

    public function updateCompany()
    {
        $validatedData = $this->validate();

        $record = Companies::find($this->company_id);
        $record->update([
            'company_name' => $this->company_name,
            'contact_person' => $this->contact_person,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('success', [
            'title' => 'Company Updated!',
            'icon' => 'success',
            'iconColor' => '#a3e635'
        ]);

    }

  

    // public function delete()
    // {
    //     if ($id) {
           
    //     }
      
    // }
}
