<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    /**
     * フォルダが持つタスク一覧を取得する
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // フォルダ削除時に関連タスクをカスケード削除
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($folder) {
            $folder->tasks()->delete();
        });
    }
}
