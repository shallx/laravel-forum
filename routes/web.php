<?php

use LaravelForum\Channel;
use LaravelForum\Discussion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use LaravelForum\Http\Controllers\UsersController;



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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('discussions', 'DiscussionController');
Route::resource('discussions/{discussion}/replies', 'RepliesController');
Route::post('discussions/{discussion}/replies/{reply}/mark-as-best-reply', 'RepliesController@reply')->name('discussions.best-reply');
Route::get('users/notifications', [UsersController::class, 'notifications'])->name('users.notifications');

Route::get('debug', function(){
    return Discussion::find('my-first-post')->get();
    
    // if(session()->has('debug')){
    //     $debug = session('debug');
    //     session()->forget('debug');
    //     return $debug;
    // }
    // return "Nothing to Debug";
});