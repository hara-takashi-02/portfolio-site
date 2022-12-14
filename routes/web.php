<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorksController;
use App\Http\Controllers\SkillsController;
use App\Http\Controllers\AllController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('site');
});*/
//Route::get('/', [WorksController::class, 'showsite'])->name('work.showsite');

Route::get('/', [AllController::class, 'showsite']);
//Route::get('/home', [AllController::class, 'showAdmin']);

Route::get('/home/', [AllController::class, 'showAdmin'], function() {
//Route::get('/home/', function() {
    if (Auth::check()) {
    return view('admin');
    }else{
    return redirect('login');
    }
})->where('home', '.*');

Route::get('/home/{any}', [AllController::class, 'showAdmin'], function() {
//Route::get('/home/{any}', function() {
    if (Auth::check()) {
    return view('admin');
    }else{
    return redirect('login');
    }
})->where('any', '.*');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();
Auth::routes(['register' => false]);