<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Folder $folder)
    {
        $folders = Folder::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->get();
        $tasks = $folder->tasks; // 選択されたフォルダに属するタスクを取得
        return view('folders', [
            'folders' => $folders,
            'tasks' => $tasks,
            'selectedFolder' => $folder
        ]);
        // $tasks = $folder->tasks; // このフォルダに属するタスクを取得
        // return view('tasks.index', [
        //     'folder' => $folder,
        //     'tasks' => $tasks
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Folder $folder)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'due_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('task_index', $folder)
                ->withErrors($validator)
                ->withInput();
        }

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;
        $task->status = 1; // 初期状態
        $task->folder_id = $folder->id;
        $task->save();

        return redirect()->route('task_index', $folder);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Folder $folder, Task $task)
    {

        return view('tasks.edit', [
            'folder' => $folder,
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Folder $folder, Task $task)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'due_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('task_edit', ['folder' => $folder, 'task' => $task])
                ->withErrors($validator)
                ->withInput();
        }

        $task->title = $request->title;
        $task->due_date = $request->due_date;
        $task->status = $request->status;
        $task->save();

        return redirect()->route('task_index', $folder);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder, Task $task)
    {
        $task->delete();
        return redirect()->route('task_index', $folder);
    }
}
