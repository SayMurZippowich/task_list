<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/', ['as' => 'pages.index', 'uses'=>'PagesController@getIndex']);

Route::resource('/admin/users', 'Admin\UsersController', ['except' => ['create','store', 'show']]);

Route::resource('tasks', 'TasksController', ['except' => ['index', 'show']]);
Route::resource('tasks', 'TasksController', ['only' => ['index', 'show']]);
Route::put('/tasks/{task}', ['as' => 'tasks.update_performer', 'uses'=>'TasksController@update_performer']);
Route::get('/tasks/{task}/set', ['as' => 'tasks.set_performer', 'uses'=>'TasksController@set_performer']);
Route::get('/tasks/{task}/complete', ['as' => 'tasks.complete', 'uses'=>'TasksController@complete']);
Route::get('/tasks/gen/new', ['as' => 'tasks.gen', 'uses'=>'TasksController@task_generate']);
Route::post('/tasks/gen/stor', ['as' => 'tasks.gen.store', 'uses'=>'TasksController@tasks_gen_store']);

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:tasks-admin')->group(function(){
    Route::resource('/users', 'UsersController', ['except' => ['create','store', 'show']]);
});
