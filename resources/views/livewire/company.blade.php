<main wire:id="I4CniArDrKTnu1hSScvB" class="main-content">
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb me-5">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Company</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">All Company</li>
            </ol>
        </nav>
        <div class="row">
            <div class="d-flex justify-content-end">
                <div class="p-2 bd-highlight">
                    <a href="#" class="btn bg-gradient-dark btn-sm mb-0" wire:click.prevent="showModal" type="button">+&nbsp; New Company</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">

                <div class="card mt-3">
                 
                    <div class="card-body px-0 pt-0 pb-2">
                        @if ($notificationMessage)
                        <div id="showSuccesNotification" class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-icon text-white"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text text-white message"></span>
                            <button wire:click="$set('showSuccesNotification', false)" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            </button>
                        </div>
                        // @endif


                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary opacity-7 table-header">
                                            ID
                                        </th>

                                        <th class="text-center text-uppercase text-secondary table-header   opacity-7">
                                            Name
                                        </th>

                                        <th class="text-center text-uppercase text-secondary table-header   opacity-7">
                                            Email
                                        </th>

                                        <th class="text-center text-uppercase text-secondary table-header opacity-7">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($companies as $company)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{$company->id}}</p>
                                        </td>

                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$company->company_name}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$company->email}}</p>
                                        </td>

                                        <td class="text-center">
                                            <a href="" wire:click.prevent="editCompany({{$company->id}})" class="mx-2 icon-edit" data-bs-toggle="modal" data-bs-target="#editModal">
                                                <i class="cursor-pointer edit-color fa fa-lg fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>

                                            <span>
                                                <a href="#" wire:click="confirmDelete({{$company->id}})" class="mx-1 icon-delete" data-bs-toggle="tooltip">
                                                    <i class="fa fa-trash-o fa-lg delete-color" aria-hidden="true"></i>

                                                </a>
                                            </span>
                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5">No Record Found</td>
                                    </tr>
                                    @endforelse
                                </tbody>

                            </table>


                        </div>
                        <div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>

<div class="row">
    <div class="col-md-4">
        <div wire:ignore.self class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal- modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        @if($showEditModal)
                        <h6 class="modal-title" id="modal-title-default">Edit Company Info</h6>
                        @else
                        <h6 class="modal-title" id="modal-title-default">Add Company Info</h6>
                        @endif

                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <form wire:submit.prevent="{{$showEditModal ? 'updateCompany' : 'saveCompany'}}">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Company Name</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" wire:model="company_name">
                                    </div>
                                    @error('company_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Email</label>
                                    <div class="input-group">
                                        <input wire:model="email" class="form-control" type="email">
                                    </div>
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-6">
                                    <label class="form-label">Address</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" wire:model="address">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Contact Person</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" wire:model="contact_person">
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-2">
                                <div class="col-6">
                                    <label class="form-label">Phone</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text" wire:model="phone">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-gradient-primary">
                                @if($showEditModal)
                                <span>Save Changes</span>
                                @else
                                <span>Save</span>
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('show-modal', event => {
        $('#companyModal').modal('show');

    })

    window.addEventListener('close-modal', event => {
        $('#companyModal').modal('hide');

        setTimeout(function() {
            $('#notif').hide();
        }, 2000);

    })

    window.addEventListener('success', e => {
        Swal.fire({
            title: e.detail.title,
            icon: e.detail.icon,
            iconColor: e.detail.iconColor,
            toast: true,
            timer: 1500,
            position: 'top-right',
            timerProgressBar: true,
            showConfirmButton: false,

        });

    })

    window.addEventListener('delete', e => {
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('deleteConfirmed')
            }
        })
    })

    window.addEventListener('deleted', e => {
        Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
        )
    })
</script>


</div>