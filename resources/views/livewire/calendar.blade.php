<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
  <div class="container-fluid py-4">

    <nav aria-label="breadcrumb me-5">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Site Supervisor</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Task List</li>
      </ol>
    </nav>

    <div class="row mb-2 mt-2">
      <div class="col-8">
        <div class="card mt-3">
          <div class="card-body px-0 pb-2">
            <div id='calendar'></div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card mt-3">
          <div class="card-body p-3">
          
            <div class="timeline timeline-one-side l-blue">
            
              <div class="timeline timeline-one-side l-green">
          
                <div class="timeline-block mb-3">
                  <div class="timeline-content" style="max-width:100%;">
                    <a href="#" wire:click="asd" class="mx-1 icon-delete" data-bs-toggle="tooltip">
                      <i class="fa fa-trash-o fa-lg float-end" aria-hidden="true" style="color:#dc2626;"></i>
                    </a>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">Not working</p>
                   
                  </div>

                </div>
              </div>

              <hr class="horizontal dark mt-4 mb-0">
          
              <!-- <div class="alert alert-warning text-center" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text">No notes for this Task..</span>
              </div> -->

            </div>
            <div class="card-footer d-block">
              <form wire:submit.prevent="addNote">
                <div class="d-flex">
                  <textarea class="form-control  @if($errors->has('note')) is-invalid @else  @endif" rows="4" wire:model="note" placeholder="Add note here..."></textarea>
                </div>
               

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



    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>




    <script>
      document.addEventListener('livewire:load', function() {

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;
        var calendarEl = document.getElementById('calendar');
        var checkbox = document.getElementById('drop-remove');
        var data = @this.events;
        var calendar = new Calendar(calendarEl, {
          events: JSON.parse(data),
          dateClick(info) {
            var title = prompt('Enter Note');

            // $('#calendarModal').modal('show');
            var date = new Date(info.dateStr + 'T00:00:00');
            if (title != null && title != '') {
              calendar.addEvent({
                task_name: title,
                start: date,
                allDay: true
              });
              var eventAdd = {
                task_name: title,
                start: date
              };
              @this.addevent(eventAdd);
              alert('Great. Now, update database...');
            } else {
              alert('Task Note is Required');
            }
          },
          editable: true,
          selectable: true,
          displayEventTime: false,
          droppable: true, // this allows things to be dropped onto the calendar
          drop: function(info) {
            // is the "remove after drop" checkbox checked?
            if (checkbox.checked) {
              // if so, remove the element from the "Draggable Events" list
              info.draggedEl.parentNode.removeChild(info.draggedEl);
            }
          },
          eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
          loading: function(isLoading) {
            if (!isLoading) {
              // Reset custom events
              this.getEvents().forEach(function(e) {
                if (e.source === null) {
                  e.remove();
                }
              });
            }
          }
        });
        calendar.render();
        @this.on(`refreshCalendar`, () => {
          calendar.refetchEvents()
        });
      });
    </script>

</main>