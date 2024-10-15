<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Validatorのインポート
use Illuminate\Support\Facades\Auth; // Authのインポート

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Folder $folder)
    {
        $folders = Folder::where('user_id', Auth::user()->id)->orderBy('created_at', 'asc')->get();
        $tasks = $folder->tasks; // このフォルダに属するタスクを取得
        return view('folders.index', [
            'folders' => $folders,
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('folders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:255',
        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        //以下に登録処理を記述（Eloquentモデル）

        // Eloquentモデル
        $folders = new Folder;
        $folders->user_id  = Auth::user()->id;
        $folders->name   = $request->name;
        $folders->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Folder $folder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($folder_id)
    {
        $folders = Folder::where('user_id', Auth::user()->id)->find($folder_id);
        return view('folders.edit', ['folder' => $folders]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Folder $folder)
    {

        //バリデーション
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required|min:1|max:255',
        ]);

        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/foldersedit/' . $request->id)
                ->withInput()
                ->withErrors($validator);
        }

        //データ更新
        $folders = Folder::where('user_id', Auth::user()->id)->find($request->id);

        $folders->name   = $request->name;
        $folders->save();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder)
    {
        $folder->delete();       //追加
        return redirect('/');  //追加
    }
}
