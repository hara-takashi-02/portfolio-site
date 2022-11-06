<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{

    public function index()
    {
        $task_index = Task::orderBy('task_sort', 'asc')->get();
        //$task_index = Task::all();
        return $task_index;
    }

    public function show(Task $task)
    {
        return $task;
    }

    /*public function store(StoreTaskRequest $request)
    {
        $img = $request->file('file');
        //dump($request->all());
        //var_dump($img);
        //exit;

        $attributes =  $request->only(['title', 'content', 'person_in_charge', 'file_path', 'file_name']);
        //return Task::create($request->all());
        return Task::create($attributes);
    }*/

    public function store(StoreTaskRequest $request)
    {
        if ($request->file('file_name')) {
        $file_name = $request->file('file_name')->getClientOriginalName();
        $file_path = $request->file('file_name')->storeAs('img', $file_name,'public');
        }else{
            $file_name = "";
            $file_path = "";
        }

        $input_content = new Task();
        $input_content->title = $request['title'];
        $input_content->content = $request['content'];
        $input_content->person_in_charge = $request['person_in_charge'];
        $input_content->file_path = $file_path;
        $input_content->file_name = $file_name;
        $input_content->save();

    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        var_dump("せいこう");
        var_dump($task);

        $content_info = $task::find($task["id"]);
        
        if ($request->file('file_name')) {
            $file_name = $request->file('file_name')->getClientOriginalName();
            $file_path = $request->file('file_name')->storeAs('img', $file_name,'public');
            //var_dump("var_dump:".$file_name);
            //var_dump("var_dump:".$file_path);
        }else{
            $file_name = "";
            $file_path = "";
        }

        $content_info->title = is_null ($request['title']) ? "" : $request['title'];
        $content_info->content = is_null ($request['content']) ? "" : $request['content'];
        $content_info->person_in_charge = is_null ($request['person_in_charge']) ? "" : $request['person_in_charge'];
        $content_info->file_path = $file_path;
        $content_info->file_name = $file_name;
        $content_info->update();

        /*$attributes =  $request->only(['title', 'content', 'person_in_charge', 'file_path', 'file_name']);
        $task->update($attributes);      
        return $task;*/ //更新したデータを返す。
    }

    public function destroy(Task $task)
    {    
        var_dump($task);
        $task->delete();
        return $task; //削除したデータを返す。
    }

    //全更新
    public function save(Request $request)
    {

        $tasks = Task::all();
        //var_dump($request);

        foreach ($tasks as $task) {
            $task->timestamps = false;
            $id = $task->id;
            foreach ($request->tasks as $taskFrontEnd) {
                if ($taskFrontEnd['id'] == $id) {
                    //var_dump($taskFrontEnd['task_sort']);
                    $task->update(['task_sort' => $taskFrontEnd['order']]);
                }
                
            }
        }

        return ;
    }
    
}
