<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreHistorysRequest;
use App\Http\Requests\UpdateHistorysRequest;
use App\Models\Historys;

class HistorysController extends Controller
{
    /*------------------
    //管理画面
    -------------------*/

    public function index() //一覧用
    {
        $history_index = Historys::orderBy('sort', 'asc')->get();
        return $history_index;
    }

    public function show(Historys $history) //個別ページ用
    {
        return $history;
    }

    public function store(StoreHistorysRequest $request) //新規ページ用
    {
        if ($request->file('file_name')) {
            $file_name = $request->file('file_name')->getClientOriginalName();
            $file_path = $request->file('file_name')->storeAs('img', $file_name, 'public');
        } else {
            $file_name = "";
            $file_path = "";
        }

        $input_historys = new Historys();
        $input_historys->title = $request['title'];
        $input_historys->content = $request['content'];
        $input_historys->age_st = $request['age_st'];
        $input_historys->age_ed = $request['age_ed'];
        $input_historys->file_path = $file_path;
        $input_historys->file_name = $file_name;

        $input_historys->save();
    }

    public function update(UpdateHistorysRequest $request, Historys $history) //更新用
    {
        $update_historys = $history::find($history["id"]);

            if ($request->file('file_name')) {
                $file_name = $request->file('file_name')->getClientOriginalName();
                $file_path = $request->file('file_name')->storeAs('img', $file_name, 'public');
            } else {
                $file_name = "";
                $file_path = "";
            }

        $update_historys->title = is_null($request['title']) ? "" : $request['title'];
        $update_historys->content = is_null($request['content']) ? "" : $request['content'];
        $update_historys->age_st = is_null($request['age_st']) ? "" : $request['age_st'];
        $update_historys->age_ed = is_null($request['age_ed']) ? "" : $request['age_ed'];
        $update_historys->file_path = $file_path;
        $update_historys->file_name = $file_name;

        $update_historys->update();
    }

    public function destroy(Historys $history) //削除用
    {
        var_dump($history);
        $history->delete();
        return $history; //削除したデータを返す。
    }


    public function save(Request $request) //全順番更新用
    {

        $historys = Historys::all();

        foreach ($historys as $history) {
            $history->timestamps = false;
            $id = $history->id;
            foreach ($request->historys as $historyFrontEnd) {
                if ($historyFrontEnd['id'] == $id) {
                    $history->update(['sort' => $historyFrontEnd['order']]);
                }
            }
        }
        return;
    }
}
