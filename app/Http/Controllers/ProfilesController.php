<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreProfilesRequest;
use App\Http\Requests\UpdateProfilesRequest;
use App\Models\Profiles;

class ProfilesController extends Controller
{
    /*------------------
    //管理画面
    -------------------*/

    public function index() //一覧用
    {
        $profiles_index = Profiles::orderBy('sort', 'asc')->get();
        return $profiles_index;
    }

    public function show(Profiles $profile) //個別ページ用
    {
        return $profile;
    }

    public function store(StoreProfilesRequest $request) //新規ページ用
    {

        $input_profiles = new Profiles();
        $input_profiles->myname = $request['myname'];
        $input_profiles->age = $request['age'];
        $input_profiles->place = $request['place'];
        $input_profiles->school = $request['school'];
        $input_profiles->content = $request['content'];

        $input_profiles->save();
    }

    public function update(UpdateProfilesRequest $request, Profiles $profile) //更新用
    {

        $update_profiles = $profile::find($profile["id"]);

        $update_profiles->myname = is_null($request['myname']) ? "" : $request['myname'];
        $update_profiles->age = is_null($request['age']) ? "" : $request['age'];
        $update_profiles->place = is_null($request['place']) ? "" : $request['place'];
        $update_profiles->school = is_null($request['school']) ? "" : $request['school'];
        $update_profiles->content = is_null($request['content']) ? "" : $request['content'];

        $update_profiles->update();
    }

    public function destroy(Profiles $profile) //削除用
    {
        var_dump($profile);
        $profile->delete();
        return $profile; //削除したデータを返す。
    }


    public function save(Request $request) //全順番更新用
    {

        $profiles = Profiles::all();

        foreach ($profiles as $profile) {
            $profile->timestamps = false;
            $id = $profile->id;
            foreach ($request->profiles as $profileFrontEnd) {
                if ($profileFrontEnd['id'] == $id) {
                    $profile->update(['sort' => $profileFrontEnd['order']]);
                }
            }
        }
        return;
    }
}
