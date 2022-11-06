<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreSkillsRequest;
use App\Http\Requests\UpdateSkillsRequest;
use App\Models\Skills;

class SkillsController extends Controller
{
    /*------------------
    //管理画面
    -------------------*/

    public function index() //一覧用
    {
        $skill_index = Skills::orderBy('sort', 'asc')->get();
        return $skill_index;
    }

    public function show(Skills $skill) //個別ページ用
    {
        return $skill;
    }

    public function store(StoreSkillsRequest $request) //新規ページ用
    {
        $input_skills = new Skills();
        $input_skills->title = $request['title'];
        $input_skills->type = $request['type'];
        $input_skills->meter = $request['meter'];

        $input_skills->save();
    }

    public function update(UpdateSkillsRequest $request, Skills $skill) //更新用
    {
        $update_skills = $skill::find($skill["id"]);

        $update_skills->type = is_null($request['type']) ? "" : $request['type'];
        $update_skills->title = is_null($request['title']) ? "" : $request['title'];
        $update_skills->meter = is_null($request['meter']) ? "" : $request['meter'];

        $update_skills->update();
    }

    public function destroy(Skills $skill) //削除用
    {
        $skill->delete();
        return $skill; //削除したデータを返す。
    }


    public function save(Request $request) //全順番更新用
    {

        $skills = Skills::all();

        foreach ($skills as $skill) {
            $skill->timestamps = false;
            $id = $skill->id;
            foreach ($request->skills as $skillFrontEnd) {
                if ($skillFrontEnd['id'] == $id) {
                    $skill->update(['sort' => $skillFrontEnd['order']]);
                }
            }
        }
        return;
    }

    /*------------------
    //サイト
    -------------------*/
    public function showsite(Skills $skill) //サイト用
    {
        $skills = Skills::all();
        return view('site', compact('skills'));
    }
}
