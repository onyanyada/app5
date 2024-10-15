<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\FolderController; //Add
use App\Models\Folder; //Add

//本：ダッシュボード表示(books.blade.php)
Route::get('/', [FolderController::class, 'index'])->middleware(['auth'])->name('folder_index');
Route::get('/dashboard', [FolderController::class, 'index'])->middleware(['auth'])->name('dashboard');

//本：追加 
Route::post('/folders', [FolderController::class, "store"])->name('folder_store');

//本：削除 
Route::delete('/folder/{folder}', [FolderController::class, "destroy"])->name('folder_destroy');

//本：更新画面
Route::post('/foldersedit/{folder}', [FolderController::class, "edit"])->name('folder_edit'); //通常
Route::get('/foldersedit/{folder}', [FolderController::class, "edit"])->name('edit');      //Validationエラーありの場合

//本：更新画面
Route::post('/folders/update', [FolderController::class, "update"])->name('book_update');

/**
 * 「ログイン機能」インストールで追加されています 
 */
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
