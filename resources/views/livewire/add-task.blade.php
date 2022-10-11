<main wire:id="I4CniArDrKTnu1hSScvB" class="main-content">
    <div class="container-fluid py-4">
        <div class="row mb-5">

            <!-- <div class="col-lg-4 mt-lg-0 mt-4">

                <div class="card mt-1" id="basic-info">
                    <div class="card-header">
                        <h5>Task</h5>
                    </div>
                    <div class="card-body pt-0">
                        
                        <div class="row mt-2">
                            <div class="col-12">
                                <label class="form-label">Company Name</label>
                                <div class="input-group">
                                    <select id="company" class="form-select" wire:model="companyId">
                                        @foreach ($companies as $company)
                                        <option value=" {{$company->id}}" wire:click="selectedCompany">{{$company->company_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{$companyId}}
                        </div>

                        <div class="row mt-2">
                            <div class="col-6">
                                <label class="form-label">Owner</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" wire:model=" {{ $company->contact_person }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Contacts</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" value="   ">

                                </div>
                            </div>
                        </div>

                       

                    </div>
                </div>


            </div> -->
            <div class="col-lg-12 mt-lg-0 mt-4">

                <div class="card mt-1" id="basic-info">
                    <div class="card-header">
                        <h5>Task</h5>
                    </div>
                    <div class="card-body pt-0">

                        <div class="row mt-2">
                            <input type="hidden" id="task_id" name="" value="{{ uniqid()}}">
                            <div class="col-lg-6 col-xl-6 col-md-12">
                                <label class="form-label">Company Name <span style="color:red"> (You can Add Company if not available)</span></label>
                                <div class="row">
                                    <div class="col-10" style="padding-right:0;">
                                        <div class="input-group ">
                                            <select id="company" class="form-select reset-select">
                                                <option value="0">Select Company</option>
                                                @foreach ($companies as $company)
                                                <option value=" {{$company->id}}">{{$company->company_name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <diV class="col-2" style="padding-left:2px;">
                                        <button wire:click.prevent="showModal" type="button" class="btn btn btn-outline-info">Add</button>
                                    </diV>
                                </div>
                            </div>

                            <div class="col-lg-6 col-xl-6 col-md-12 ">
                                <label class="form-label">Project Name</label>
                                <div class="input-group ">

                                    <select id="project_name" class="form-select ">
                                        <option value="Project 1" selected>Project 1 </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-6">
                                <label class="form-label">Contact Person</label>
                                <div class="input-group">
                                    <input id="contact_person" class="form-control reset" type="text">
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Phone</label>
                                <div class="input-group">
                                    <input id="phone" class="form-control reset" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-6 col-xl-6 col-md-12">
                                <label class="form-label">Task Name</label>
                                <div class="input-group">
                                    <input id="task_name" class="form-control reset" type="text">
                                </div>
                            </div>

                            <div class="col-lg-6 col-xl-6 col-md-12">
                                <label class="form-label">Category <span style="color:red"> (You can Add Category if not available)</span></label>
                                <div class="row">
                                    <div class="col-10" style="padding-right:0;">
                                        <div class="input-group ">
                                            <select id="project_name" class="form-select ">
                                                <option value="Category 1" selected>Category 1 </option>
                                            </select>
                                        </div>
                                    </div>
                                    <diV class="col-2" style="padding-left:2px;">
                                        <button wire:click.prevent="showModal" type="button" class="btn btn btn-outline-info">Add</button>
                                    </diV>
                                </div>
                            </div>



                        </div>

                        <div class="row mt-2">
                            <div class="col-4">
                                <label class="form-label">Send Date</label>
                                <div class="input-group">
                                    <input class="form-control reset" type="date" value="s" id="send_date">
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Due Date</label>
                                <div class="input-group">
                                    <input class="form-control reset" type="date" value="" id="due_date">
                                </div>
                            </div>

                            <div class="col-4">
                                <label class="form-label">Received Date</label>
                                <div class="input-group">
                                    <input class="form-control reset" type="date" value="" id="received_date">
                                </div>
                            </div>


                        </div>

                        <form method="POST" enctype="multipart/form-data" id="image-upload" action="javascript:void(0)">
                            <div class="row mt-3 mb-3">
                                <label class="form-label">file Upload</label>
                                <div class="col-4" style="padding-right:0;">

                                    <input type="file" name="image" placeholder="" id="image" class="form-control form-control-sm">
                                </div>
                                <div class="col-2" style="padding-left:1px;">
                                    <button type=" submit" class="btn btn-outline-success btn-sm" id="submit">Upload</button>
                                </div>
                                <div class="col-6">
                                    <div class=" col-md-12 d-flex justify-content-end">

                                    <button id="save-task" type="button" class="btn bg-gradient-dark  mb-0" id="submit">+&nbsp; Save Task</button>
                                </div>
                            </div>
                    </div>
                    </form>
                    <div class="row mt-2">
                        <div class="col-6">
                            <label class="form-label">Uploaded File</label>
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="media">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>



            </div>
        </div>


    </div>



    </div>


    <div class="row">
        <div class="col-md-4">
            <div wire:ignore.self class="modal fade" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal- modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-default">Add Company Info</h6>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form wire:submit.prevent="{{'saveCompany'}}">
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
                                <button type="submit" class="btn bg-gradient-dark">

                                    <span>Save</span>

                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
    <script type="text/javascript">
        document.addEventListener('livewire:load', function() {
            $('#company').change(function() {
                var id = $(this).children(":selected").val();
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "POST",
                    url: "{{url('get_single_company')}}",
                    data: {
                        _token: CSRF_TOKEN,
                        "company_id": id,
                    },
                    success: function(res) {
                        $('#contact_person').val(res.contact_person);
                        $('#phone').val(res.phone);
                        // console.log(res);
                    }
                });
            });


            $("#save-task").click(function() {

            });


        })
    </script>

    <script>
        document.addEventListener('livewire:load', function() {


            var taskID = $('#task_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('#image-upload').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('taskID', taskID),

                    $.ajax({
                        type: 'POST',
                        url: APP_URL + "/save-media",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            this.reset();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'File uploaded!',
                                showConfirmButton: false,
                                toast: true,
                                timer: 1500
                            })

                            loadMedia();
                        },
                        error: function(data) {

                        }
                    });
            });

            // Save Task button
            $("#save-task").on("click", function() {

                let companyName = $('#company').find(":selected").text(),
                    contactPerson = $('#contact_person').val(),
                    phone = $('#phone').val(),
                    projectName = $('#project_name').val(),
                    taskName = $('#task_name').val(),
                    sendDate = $("#send_date").val(),
                    dueDate = $("#due_date").val(),
                    receivedDate = $("#received_date").val(),
                    taskId = $("#task_id").val();

                $.ajax({
                    url: APP_URL + "/save-task",
                    type: "post",
                    data: {
                        "companyName": companyName,
                        "contactPerson": contactPerson,
                        "phone": phone,
                        "projectName": projectName,
                        "sendDate": sendDate,
                        "dueDate": dueDate,
                        "receivedDate": receivedDate,
                        "taskName": taskName,
                        "taskId": taskId
                    },
                    success: function(response) {
                        var new_Id = "<?php echo uniqid(); ?>";
                        $(".reset").val("");
                        $('.reset-select').prop('selectedIndex', 0);
                        $("#taskid").val(new_Id);
                        $('#media').html("");
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'New Task Added!',
                            showConfirmButton: false,
                            toast: true,
                            timer: 3000
                        })
                    }
                });




            });


        });


        function loadMedia() {
            var taskID = $('#task_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: APP_URL + "/load-media",
                type: "POST",
                data: {
                    "taskID": taskID
                },
                success: function(response) {

                    console.log(response);
                    $('#media').html("");
                    for (var x in response) {
                        var html = '<tr>' +
                            '<td>' +
                            '<p class="text-sm font-weight-bold mb-0" >' + response[x].file_name + '</p>' +
                            '</td>' +
                            '<td class="align-middle">' +
                            '<button class="btn btn-link text-secondary mb-0">' +
                            '<i class="fa fa-trash-o trash fa-lg" aria-hidden = "true" ></i>' +
                            '</button>' +
                            '</td>' +
                            '</tr>';

                        $('#media').append(html);
                    }


                }
            });
        }
    </script>





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
</main>