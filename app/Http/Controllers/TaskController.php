<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Task;
use App\Models\Media;
use App\Models\Categories;
use App\Models\Notes;
use DB;
use Validator;
class TaskController extends Controller

{
    public function saveTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'projectName' => 'required',
            'contactPerson' => 'required',
            'taskName' => 'required',
            'companyName' => 'required',
            'category' => 'required',
        ]);

        $lastID = Task::where('owner_id', auth()->user()->owner_id)->max('sort_id');

        //return $request->all();
        if ($validator->fails()) {
            return response()->json(["status" => "error", "errors" => $validator->messages()],404);
        } else {
            $task = new Task();
            $task->task_name = $request->task_name;
            $task->company_id = $request->companyName;
            $task->project_id = $request->projectName;
            $task->contact_person = $request->contactPerson;
            $task->phone = $request->phone;
            $task->task_name = $request->taskName;
            $task->task_id = $request->taskId;
            $task->send_date = $request->sendDate;
            $task->start = $request->sendDate;
            $task->due_date = $request->dueDate;
            $task->received_date = $request->receivedDate;
            $task->owner_id = auth()->user()->owner_id;
            $task->category_id = $request->category;
            $task->sort_id = $lastID+1;
            $task->save();
        }   
    }

    public function storeMedia(Request $request)
    {

        $name = $request->file('image')->getClientOriginalName();

        $path = $request->file('image')->store('public/images');
        $save = new Media;

        $save->file_name = $name;
        $save->path = $path;
        $save->task_id = $request->taskID;

        $save->save();

        return response()->json($path);
    }

    public function loadMedia(Request $request)
    {
        $media = Media::where('task_id', $request->taskID)->get(); 

        return $media;
    }

    public function loadTask()
    {
    
        $tasks = Task::all();

        return $tasks;
    }

   

    public function test(){



        $events = DB::table('tasks')
            ->select('task_id', 'task_name', 'send_date')
            ->get();

        return $events;


    }

   

    
}
