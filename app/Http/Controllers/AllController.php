<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Skills;
use App\Models\Works;
use App\Models\Products;
use App\Models\Profiles;
use App\Models\Historys;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AllController extends Controller

{
    /*------------------
    //サイト
    -------------------*/
    public function showsite(Works $work, Skills $skill, Products $product, Profiles $profile, Historys $history) //サイト用
    {
        
        //if (Auth::check()) {
        $works = Works::orderBy('sort', 'asc')->get();
        $skills = Skills::orderBy('sort', 'asc')->get();
        $products = Products::orderBy('sort', 'asc')->get();
        $profiles = Profiles::orderBy('sort', 'asc')->get();
        $historys = Historys::orderBy('sort', 'asc')->get();
       //}

        return view('site', compact('works','skills','products','profiles','historys'));
    }

}
