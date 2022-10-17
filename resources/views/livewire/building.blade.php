<main wire:id="I4CniArDrKTnu1hSScvB" class="main-content">
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb me-5">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Building Administration</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Task List</li>
            </ol>
        </nav>
        <div class="row">
            <div class="d-flex justify-content-between">
                <div class="mt-3 w-25 ">
                    <div class="input-group align-middle" style="width:100%;">
                        <select class=" form-select" wire:model="selectedCategory">
                            @if (count($categories) > 0)
                            <option value="" selected>All Stages</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->stage_name}} </option>
                            @endforeach
                            @else
                            <option value="0" disabled>Please Add new Company</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="p-2 bd-highlight">
                    <a href="{{ route('add-task') }}" class="btn bg-gradient-dark btn-sm mb-0" type="button">+&nbsp;New Task</a>
                </div>
            </div>
        </div>
        <div class="row mb-2 mt-2">
            <div class="col-lg-12 mt-lg-0 mt-4">

                @foreach ($tasks as $category => $item)
                <div class="card mt-3">
                    <div class="card-header pb-0 p-3">
                        <div class="text-center mb-">
                            <h6 class="mb-0">{{ $category }}</h6>
                            <hr class="horizontal dark mt-3 mb-1">
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group list-group-flush list my--3 ">
                            <li class="list-group-item px-0 border-0">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <p class="text-xs font-weight-bold mb-0">Task Name</p>
                                    </div>
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Send Date - Due Date</p>
                                    </div>
                                    <div class="col text-center">
                                        <p class="text-xs font-weight-bold mb-0">Action</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <ul class="list-group list-group-flush list my--3 sort_menu" wire:sortable="updateTaskOrder" wire:sortable.animation="150" class="divide-y divide-gray-200">
                            @foreach ($item as $x => $service)
                            <li class="l-task list-group-item px-0 border-0 task-li" data-id="{{$service->id}}" wire:sortable.item="{{ $service->id }}">
                                <div class="row align-items-center handle ">
                                    <div class="col">
                                        <div class="d-inline-block">
                                            @if ($x == 0)
                                            <button class="btn-sort btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i data-id="{{$service->id}}" class="btn-sort fas fa-arrow-down" aria-hidden="true"></i></button>

                                            @else
                                            <button class=" btn-sort btn btn-icon-only btn-rounded btn-outline-success mb-0 me-1 p-3 btn-sm d-flex align-items-center justify-content-center"><i data-id="{{$service->id}}" class="btn-sort fas fa-arrow-up" aria-hidden="true"></i></button>
                                            @endif
                                        </div>
                                        <div class="d-inline-block">
                                            <h6 class="text-sm mb-0 ">{{ $service->task_name }}</h6>
                                        </div>
                                    </div>
                                    <div class="col text-center">
                                        <h6 class="text-sm mb-0"><span class="green"> {{date('M d, Y', strtotime($service->send_date))}}</span> - <span class="red">{{date('M d, Y', strtotime($service->due_date))}}</span></h6>
                                    </div>

                                    <div class="col text-center">
                                        <button type="button" class="btn btn-outline-success btn-sm me-2" wire:click.prevent="viewNotes({{$service->id}})" data-toggle="tooltip" data-placement="top" title="">Notes</small></button>
                                        <button type="button" class="btn btn-outline-info btn-sm " wire:click.prevent="editTask({{$service->id}})">View</button>
                                    </div>
                                </div>
                            </li>

                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach



            </div>
        </div>



        <!-- TASK MODAL -->
        <div class="row">
            <div class="col-md-4">
                <div wire:ignore.self class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                    <div class="modal-dialog  modal- modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h6 class="modal-title" id="modal-title-default">Edit Task</h6>


                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form wire:submit.prevent="updateTask">
                                <div class="modal-body">
                                    <div class="row mt-2">
                                        <input type="hidden" id="task_id" name="" value="{{ uniqid()}}">
                                        <div class="col-lg-6 col-xl-6 col-md-12">
                                            <label class="form-label">Company Name</label>
                                            <div class="row">
                                                <div class="col-12" style="padding-right:0;">
                                                    <div class="input-group ">
                                                        <select class="form-select" wire:model.defer="company_id">
                                                            <!-- <option value="0">Select Company</option> -->
                                                            @foreach ($companylist as $company)
                                                            <option value="{{$company->id}}">{{$company->company_name}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-xl-6 col-md-12 ">
                                            <label class="form-label">Project Name</label>
                                            <div class="input-group ">
                                                <select class="form-select" wire:model.defer="project_id">
                                                    @foreach ($projects as $project)
                                                    <!-- <option value="{{$project->id}}">{{$project->project_name}}</option> -->
                                                    <option value="{{ $project->id }}">{{$project->project_name }}</option>
                                                    @endforeach
                                                </select>
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
                                        <div class="col-6">
                                            <label class="form-label">Contact Person</label>
                                            <div class="input-group">
                                                <input class="form-control" type="text" wire:model="contact_person">
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row mt-2">
                                        <div class="col-lg-6 col-xl-6 col-md-12 mt-2">
                                            <label class="form-label">Category</label>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="input-group ">
                                                        <select class="form-select" wire:model.defer="category_id">
                                                            @foreach ($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->stage_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-xl-6 col-md-12 mt-2">
                                            <label class="form-label">Task Name</label>
                                            <div class="input-group">
                                                <input id="task_name" class="form-control reset taskName" type="text" wire:model="task_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-4">
                                            <label class="form-label">Send Date</label>
                                            <div class="input-group">
                                                <input class="form-control reset" type="date" wire:model="send_date">
                                            </div>
                                        </div>


                                        <div class="col-4">
                                            <label class="form-label">Received Date</label>
                                            <div class="input-group">
                                                <input class="form-control reset" type="date" wire:model="received_date">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label class="form-label">Due Date</label>
                                            <div class="input-group">
                                                <input class="form-control reset" type="date" wire:model="due_date">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-gradient-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn bg-gradient-dark">

                                        <span>Save Changes</span>

                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NOTES MODAL -->
        <div class="row">
            <div class="col-md-4">
                <div wire:ignore.self class="modal fade" id="notesModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                    <div class="modal-dialog  modal- modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h6 class="modal-title" id="modal-title-default">Notes</h6>


                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="card-body p-3">
                                    @if (count($noteslist) > 0)
                                    @foreach($noteslist as $x => $note)
                                    @if($x % 2 == 0)
                                    <div class="timeline timeline-one-side l-blue">
                                        @else
                                        <div class="timeline timeline-one-side l-green">
                                            @endif
                                            <div class="timeline-block mb-3">
                                                <div class="timeline-content" style="max-width:100%;">
                                                    <a href="#" wire:click="deleteNote({{$note->id}})" class="mx-1 icon-delete" data-bs-toggle="tooltip">
                                                        <i class="fa fa-trash-o fa-lg float-end" aria-hidden="true" style="color:#dc2626;"></i>
                                                    </a>
                                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{date('M d Y', strtotime($note->created_at))}}</p>
                                                    <p class="text-sm mt-3 mb-2">
                                                        {{$note->note}}
                                                    </p>
                                                </div>

                                            </div>
                                        </div>

                                        <hr class="horizontal dark mt-4 mb-0">
                                        @endforeach
                                        @else
                                        <div class="alert alert-warning text-center" role="alert">
                                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                            <span class="alert-text">No notes for this Task..</span>
                                        </div>

                                        @endif
                                    </div>
                                    <div class="card-footer d-block">
                                        <form wire:submit.prevent="addNote">

                                            <div class="d-flex">
                                                <textarea class="form-control" rows="4" wire:model="note"></textarea>
                                            </div>
                                            @error('note') <span class="text-danger">{{ $message }}</span> @enderror

                                            <div class="clearfix float-end mt-2">
                                                <button type="button" class="btn bg-gradient-secondary " wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn bg-gradient-dark">
                                                    <span>Add Notes</span>
                                                </button>
                                            </div>

                                        </form>


                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <script type="text/javascript">
            document.addEventListener('livewire:load', function() {
                $('#companys').change(function() {
                    var id = $(this).children(":selected").val();
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type: "POST",
                        url: "{{url('get_single_company')}}",
                        data: {
                            _token: CSRF_TOKEN,
                            "id": 1,
                        },
                        success: function(res) {
                            // console.log(res);
                        }
                    });

                });

                $('[data-toggle="tooltip"]').tooltip()

            })

            window.addEventListener('show-modal', event => {
                $('#taskModal').modal('show');

            })
            window.addEventListener('close-modal', event => {
                $('#taskModal').modal('hide');

            })

            window.addEventListener('show-notes-modal', event => {
                $('#notesModal').modal('show');

            })

            window.addEventListener('close-modal-notes', event => {
                $('#notesModal').modal('hide');

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
        </script>

</main>