<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\TaskStatus;
use Session;
use Gate;

class TasksController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('can:tasks-admin')->except(['index', 'show', 'complete']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('tasks-admin')) {
            $tasks = Task::where('performer_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(3);
            return view('tasks.index')->withTasks($tasks);
        }
        else {
            $tasks = Task::orderBy('id', 'desc')->paginate(3);
            return view('tasks.index')->withTasks($tasks);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $performers[""] = 'No performer';
        $performers += User::pluck('name', 'id')->toArray();
        return view('tasks.create')->withPerformers($performers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validating data
        $this->validate($request, array(
                'performer_id'=>'nullable|integer',
                'description' => 'required|max:255'
            ));
        // store data
        $task = new Task;

        $task->creator_id = Auth::user()->id;

        if (empty($request->performer_id)) {
        $task->performer_id = null;
        $task->task_status_id = TaskStatus::select('id')->where('status', 'green')->first()->id;
        }
        else {
        $task->performer_id = $request->performer_id;
        $task->task_status_id = TaskStatus::select('id')->where('status', 'yellow')->first()->id;
        }

        $task->description = $request->description;

        $task->save();
        Session::flash('success', "The task was successfully created");
        // redirect >>
        return redirect()->route('tasks.show', $task->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('tasks-performers', [$id]) || Gate::allows('tasks-admin')) {
            $task = Task::find($id);
            return view('tasks.show')->withTask($task);
        }
        else {
            return redirect()->route('tasks.index');
        }
    }

    public function set_performer($id)
    {
        $task = Task::find($id);
        $performers[""] = 'No performer';
        $performers += User::pluck('name', 'id')->toArray();
        return view('tasks.set_performer')->withTask($task)->withPerformers($performers);
    }

    public function update_performer(Request $request, $id)
    {
        #Task::where('id', $id)->update(array('performer_id' => $request->performer_id));
        $task = Task::find($id);

        $task->performer_id = $request->performer_id;

        if (empty($request->performer_id)) {
            $task->task_status_id = TaskStatus::select('id')->where('status', 'green')->first()->id;
        }
        $task->save();
        return redirect()->route('tasks.show', $id);
    }

    public function complete($id) {
        if (Gate::allows('tasks-performers', [$id]) || Gate::allows('tasks-admin')) {
            $task_status_id = TaskStatus::select('id')->where('status', 'blue')->first()->id;
            Task::where('id', $id)->update(array('task_status_id' => $task_status_id));
            return redirect()->route('tasks.show', $id);
        }
        else {
            return redirect()->route('tasks.index');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);

        $performers[""] = 'No performer';
        $performers += User::pluck('name', 'id')->toArray();
        $task_statuses = TaskStatus::pluck('status', 'id');
        return view('tasks.edit')->withTask($task)->withPerformers($performers)->withStatuses($task_statuses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        $this->validate($request, array(
                'performer_id'=>'nullable|integer',
                'task_status_id'=>'integer',
                'description' => 'required|max:255'
            ));

        $task->performer_id = $request->performer_id;
        $task->task_status_id = $request->task_status_id;
        $task->description = $request->description;

        $task->save();
        Session::flash('success', "The task was successfully updated");
        // redirect >>
        return redirect()->route('tasks.show', $task->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        //
        $task->delete();

        Session::flash('success', "The task was successfully deleted!");
        return redirect()->route('tasks.index');
    }
}
