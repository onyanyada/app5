<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\FolderController; //Add
use App\Models\Folder; //Add
use App\Http\Controllers\TaskController; //Add
use App\Models\Task; //Add

//フォルダ
Route::get('/', [FolderController::class, 'index'])->middleware(['auth'])->name('folder_index');
Route::get('/dashboard', [FolderController::class, 'index'])->middleware(['auth'])->name('dashboard');

// フォルダ作成フォーム表示用のルート
Route::get('/folders/create', [FolderController::class, 'create'])->name('folder_create');

//フォルダ：追加 
Route::post('/folders', [FolderController::class, "store"])->name('folder_store');


//フォルダ：削除 
Route::delete('/folder/{folder}', [FolderController::class, "destroy"])->name('folder_destroy');

//フォルダ：更新画面
Route::post('/foldersedit/{folder}', [FolderController::class, "edit"])->name('folder_edit'); //通常
Route::get('/foldersedit/{folder}', [FolderController::class, "edit"])->name('edit');      //Validationエラーありの場合

//フォルダ：更新画面
Route::post('/folders/update', [FolderController::class, "update"])->name('book_update');



// フォルダのタスクを表示するルート
Route::get('/folders/{folder}', [TaskController::class, 'index'])->name('task_index');

// タスク作成フォーム表示用のルート
Route::get('/folders/{folder}/create', [TaskController::class, 'create'])->name('task_create');

// タスク追加
Route::post('/folders/{folder}/tasks', [TaskController::class, 'store'])->name('task_store');

// タスク編集画面表示
Route::get('/folders/{folder}/tasks/{task}/edit', [TaskController::class, 'edit'])->name('task_edit');

// タスク更新
Route::post('/folders/{folder}/tasks/{task}/update', [TaskController::class, 'update'])->name('task_update');

// タスク削除
Route::delete('/folders/{folder}/tasks/{task}', [TaskController::class, 'destroy'])->name('task_destroy');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
