<main wire:id="I4CniArDrKTnu1hSScvB" class="main-content">
    <div class="container-fluid py-4">
        <div class="row mb-5">


            <div class="col-lg-12">
                <div class="card h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="card-header pb-0">
                            <div class="d-flex flex-row justify-content-between">
                                <div>
                                    <h5 class="mb-0">Task List</h5>
                                </div>
                                <a href="{{ route('add-task') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;New Task</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group sort_menu" id="task-list">
                            @foreach ($data as $row)
                            <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg" data-id="{{$row->id}}">
                                <div class="d-flex handle">
                                    <div class="d-flex align-items-center">
                                        <button data-id="{{$row->id}}" class="btn-sort btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i data-id="{{$row->id}}" class="btn-sort fas fa-arrow-up" aria-hidden="true"></i></button>
                                        <button data-id="{{$row->id}}" class="btn-sort btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i data-id="{{$row->id}}" class="btn-sort fas fa-arrow-down" aria-hidden="true"></i></button>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark t-title"> {{$row->task_name}}</h6>
                                            <span class="text-xs"><small class="start_date">Start Date:</small> <small>{{date('M d Y', strtotime($row->send_date))}}</small></span>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold ms-auto">
                                        <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt me-2" aria-hidden="true"></i>Delete</a>
                                    </div>
                                </div>
                                <hr class="horizontal dark mt-3 mb-2">
                            </li>
                            @endforeach
                        </ul>
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
    </script>

</main>