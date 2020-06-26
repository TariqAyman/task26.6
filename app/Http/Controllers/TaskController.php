<?php

namespace App\Http\Controllers;

use App\Helpers\TaskStatus;
use App\Project;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //
        $projects = Project::all();
        if ($request->has('project_id')){
            $tasks = Task::where('project_id',$request->get('project_id'))->latest()->paginate(15);
        }else{
            $tasks = Task::latest()->paginate(15);
        }
        return view('task.list',compact('projects','tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title' => 'required',
            'project_id' => 'required|exists:projects,id',
        ]);

        $data = $request->all() + ['status' => TaskStatus::InProgress];

        Task::create($data);

        return redirect()->route('tasks.index')->withSuccess('Success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $task = Task::findOrFail($id);
        $projects = Project::all();
        return view('task.edit', compact('task','projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->all();

        Task::find($id)->update($data);

        return redirect()->back()->withSuccess('Success Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        $task = Task::find($id);
        if (isset($task)) {
            $task->delete();
            return redirect()->back()->withSuccess('Success Deleted');
        } else {
            return redirect()->back()->withErrors('Task Not Found');
        }
    }
}
