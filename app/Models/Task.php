<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * タスクが所属するフォルダを取得する
     */
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
