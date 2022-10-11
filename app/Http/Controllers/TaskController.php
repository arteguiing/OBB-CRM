<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Task;
use App\Models\Media;
use Validator;
class TaskController extends Controller

{
    public function saveTask(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'projectName' => 'required',
            'contactPerson' => 'required',
            'taskName' => 'required',
        ]);

        //return $request->all();
        if ($validator->fails()) {
            return response()->json(["status" => "error", "errors" => $validator->messages()]);
        } else {
            $task = new Task();
            $task->task_name = $request->task_name;
            $task->company_name = $request->companyName;
            $task->project_name = $request->projectName;
            $task->contact_person = $request->contactPerson;
            $task->task_name = $request->taskName;
            $task->task_id = $request->taskId;
            $task->send_date = $request->sendDate;
            $task->due_date = $request->dueDate;
            $task->received_date = $request->receivedDate;
            $task->owner_id = auth()->user()->owner_id;
            
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

    public function updateOrder(Request $request)
    {
        if ($request->has('ids')) {
            $arr = explode(',', $request->input('ids'));

            foreach ($arr as $sortOrder => $id) {
                $menu = Task::find($id);
                $menu->sort_id = $sortOrder;
                $menu->save();
            }
            return ['success' => true, 'message' => 'Updated'];
        }
    }

   

    
}
