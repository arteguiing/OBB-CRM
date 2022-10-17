<main wire:id="I4CniArDrKTnu1hSScvB" class="main-content">
    <div class="container-fluid py-4">
        <nav aria-label="breadcrumb me-5">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Building Administration</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Task List</li>
            </ol>
        </nav>
        <div class="row mb-2 mt-2">


            <div class="col-lg-12">
                <div class="card h-100">
                    <div class="card-header ">
                        <div class="d-flex flex-row justify-content-between">
                            <a href="{{ route('add-task') }}" class="btn bg-gradient-dark btn-sm mb-0" type="button">+&nbsp;New Task</a>
                        </div>

                        <div class="d-flex  justify-content-start">
                            <div class="">
                                <label class="me-2" for=" inputGroupSelect01">Filter by Category: </label>
                            </div>

                            <select class="form-select w-25" wire:model="selectedCategory">
                                @if (count($categories) > 0)
                                <option value="" selected>All Category</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->stage_name}} </option>
                                @endforeach
                                @else
                                <option value="0" disabled>Please Add new Company</option>
                                @endif
                            </select>
                        </div>
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="mb-0">Transactions</h6>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>


                    <div class="card-body py-3">
                        @if (count($tasks) > 0)
                        <ul class="list-group sort_menu" id="task-list">
                            @foreach ($tasks as $task)
                            <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg" data-id="{{$task->id}}">
                                <div class="d-flex handle">
                                    <div class="d-flex align-items-center">
                                        <button data-id="{{$task->id}}" class="btn-sort btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i data-id="{{$task->id}}" class="btn-sort fas fa-arrow-up" aria-hidden="true"></i></button>
                                        <button data-id="{{$task->id}}" class="btn-sort btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i data-id="{{$task->id}}" class="btn-sort fas fa-arrow-down" aria-hidden="true"></i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark t-title"> {{$task->task_name}}</h6>
                                            <span class="text-xs font-weight-bolder py-1">Start Date: <small>{{date('M d Y', strtotime($task->send_date))}}</small></span>
                                            <span class="text-xs font-weight-bolder"><small class="start_date">Category:</small> <small>{{$task->stage_name}}</small></span>

                                        </div>


                                    </div>
                                    <div class="d-flex align-items-center text-sm font-weight-bold ms-auto">

                                        <button type="button" class="btn btn-outline-success btn-sm me-2" wire:click.prevent="viewNotes({{$task->id}})">Notes</small></button>
                                        <button type="button" class="btn btn-outline-info btn-sm " wire:click.prevent="editTask({{$task->id}})">View</button>
                                        <!-- <a class=" btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>Delete</a> -->
                                    </div>
                                </div>
                                <hr class="horizontal dark mt-3 mb-2">
                            </li>
                            @endforeach
                        </ul>

                        @else
                        <div class="alert alert-warning text-center" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                            <span class="alert-text">No Task Available!</span>
                        </div>
                        @endif
                    </div>

                </div>
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
                                            <label class="form-label">Due Date</label>
                                            <div class="input-group">
                                                <input class="form-control reset" type="date" wire:model="due_date">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <label class="form-label">Received Date</label>
                                            <div class="input-group">
                                                <input class="form-control reset" type="date" wire:model="received_date">
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
                                    @foreach($noteslist as $note)

                                    <div class="timeline timeline-one-side">
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
                        console.log(res);
                    }
                });

            });


            function updateToDatabase(idString) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    }
                });

                $.ajax({

                    url: APP_URL + "/sort-task",
                    method: 'POST',
                    data: {
                        ids: idString
                    },
                    success: function() {

                        //do whatever after success
                    }
                })
            }

            var target = $('.sort_menu');
            target.sortable({
                handle: '.handle',
                placeholder: 'highlight',
                axis: "y",
                update: function(e, ui) {
                    var sortData = target.sortable('toArray', {
                        attribute: 'data-id'
                    })
                    updateToDatabase(sortData.join(','))
                }
            })

            $(".btn-sorst").on("click", function() {
                var data1 = $(this).attr("data-id") // STILL returns 123!!!
                updateToDatabase(data1);

            })
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