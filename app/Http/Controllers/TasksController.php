<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Task;
use App\Http\Requests\TaskDataRequest; 
use View;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks=Task::all();
        return View::make('pages.index')->with('tasks', $tasks);
        //return View::make('pages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('pages.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskDataRequest $request)
    {
        $task = new Task;

        $task->title=$request->get('title'); 
        $task->description=$request->get('description'); 

        $task->save();
        $request->session()->flash('flash_message', 'New task added successfully');

        return redirect()->back();  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = new Task;
        $task = Task::findOrFail($id);
        return view('pages.show')->with('task', $task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('pages.edit')->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskDataRequest $request, $id)
    {
        //$Task = new Task;
        $task = Task::findOrFail($id);

        $task->title=$request->get('title'); 
        $task->description=$request->get('description'); 

        $task->save();
        $request->session()->flash('flash_message', 'New task added successfully');

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = new Task;
        $task = Task::findOrFail($id);
        $task->delete();
        session()->flash('flash_message', 'Task successfully deleted');
        return redirect()->route('tasks.index');
    }
}
