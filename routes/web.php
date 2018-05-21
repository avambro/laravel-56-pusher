<?php

use App\Tasks;
use App\Events\TaskCreated;
use App\Project;

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


Route::get('/projects/{project}', function (Project $project) {

    $tasks = $project->load('tasks');
    return view('welcome', compact('tasks'));
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');




Route::get('/', function () {
    //return view('welcome');
    return 'hello home';
});





//api
Route::get('/api/projects/{project}', function (Project $project) {

    return $project->tasks->pluck('body');

});


Route::post('/api/projects/{project}/tasks', function (Project $project) {
    $task = $project->tasks()->create(request(['body']));
    event(new TaskCreated($task));
    return $task;
});
