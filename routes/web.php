<?php

use App\Events\OrderStatusUpdated;
use App\Tasks;
use App\Events\TaskCreated;

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
/*
Route::get('/', function () {
    OrderStatusUpdated::dispatch();
    return view('welcome');
});*/

Route::get('/', function () {
    return view('welcome');
});

/*
Route::get('/tasks', function () {
    return Tasks::latest()->pluck('body');
});

Route::post('/tasks', function () {
    $task = Tasks::forceCreate(request(['body']));

    //Important to add dontBroadcastToCurrentUser , because it avoid to send
    //the notification to the same user
    event(new TaskCreated($task));
});
*/

Route::get('/projects/{project}', function (Project $project) {
    $project->load('tasks');
    return view('project.show', compact('project'));
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
