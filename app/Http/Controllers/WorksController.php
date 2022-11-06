<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreWorksRequest;
use App\Http\Requests\UpdateWorksRequest;
use App\Models\Works;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
//use Auth;

class WorksController extends Controller
{

    /*------------------
    //管理画面
    -------------------*/

    public function index() //一覧用
    {
        $work_index = Works::orderBy('sort', 'asc')->get();
        return $work_index;
    }

    public function show(Works $work) //個別ページ用
    {
        return $work;
    }

    public function store(StoreWorksRequest $request) //新規ページ用
    {
        if ($request['type'] == 0) {
            if ($request->file('file_name')) {
                $file_name = $request->file('file_name')->getClientOriginalName();
                $file_path = $request->file('file_name')->storeAs('img', $file_name, 'public');
            } else {
                $file_name = "";
                $file_path = "";
            }
        };

        $input_works = new Works();
        $input_works->title = $request['title'];
        $input_works->type = $request['type'];
        if ($request['type'] == 0) {
            $input_works->content = $request['content'];
            $input_works->file_path = $file_path;
            $input_works->file_name = $file_name;
        } else {
            $input_works->free_txt = $request['free_txt'];
        };
        $input_works->save();
    }

    public function update(UpdateWorksRequest $request, Works $work) //更新用
    {

        $update_works = $work::find($work["id"]);

        if ($request['type'] == 0) {
            if ($request->file('file_name')) {
                $file_name = $request->file('file_name')->getClientOriginalName();
                $file_path = $request->file('file_name')->storeAs('img', $file_name, 'public');
            } else {
                $file_name = "";
                $file_path = "";
            }
        };

        $update_works->title = is_null($request['title']) ? "" : $request['title'];
        if ($request['type'] == 0) {
            $update_works->content = is_null($request['content']) ? "" : $request['content'];
            $update_works->file_path = $file_path;
            $update_works->file_name = $file_name;
        } else {
            $update_works->free_txt = is_null($request['free_txt']) ? "" : $request['free_txt'];
        };
        $update_works->update();
    }

    public function destroy(Works $work) //削除用
    {
        $work->delete();
        return $work; //削除したデータを返す。
    }


    public function save(Request $request) //全順番更新用
    {
        //$user = Auth::user()->type;
        //$user = Auth::check();
        $user = auth()->user();
        var_dump($user);
        //$user = 0;

        //if($user == 0){
            $works = Works::all();

            foreach ($works as $work) {
                $work->timestamps = false;
                $id = $work->id;
                foreach ($request->works as $workFrontEnd) {
                    if ($workFrontEnd['id'] == $id) {
                        $work->update(['sort' => $workFrontEnd['order']]);
                    }
                }
            }
            return;
        //}
    }
}
