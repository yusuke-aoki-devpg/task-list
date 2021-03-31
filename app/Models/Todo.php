<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    // ユーザーとタスクの関係性をモデルにも記述します。
    public function user(){

        return $this->belongsTo(User::class);
        
    }

    // use HasFactory;
    protected $fillable = [
        'todo',
        'deadline',
    ];


    // ここ追加
    protected $dates = [
        'created_at',
        'updated_at',
        'deadline' //追加する
    ];
    
}
