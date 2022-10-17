<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\Event;
use DB;

class Calendar extends Component
{
    public $events = '';

    public function getevent()  
    {       
        $events = Task::select('id','task_name','start')->get();

        return  json_encode($events);
    }

    public function addevent($event)
    {
        $input['task_name'] = $event['task_name'];
        $input['start'] = $event['start'];
        Task::create($input);
    }

    public function eventDrop($event, $oldEvent)
    {
      $eventdata = Task::find($event['id']);
      $eventdata->start = $event['start'];
      $eventdata->save();
    }


    public function render()
    {
        //$events = Event::select('id','title', 'start')->get();
        $events = DB::table('tasks')
        ->select('task_id','task_name as title','start')
        ->get();

        $this->events = json_encode($events);

        return view('livewire.calendar');

    }
}
