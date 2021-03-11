<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    // ユーザーとタスクの関係性をモデルにも記述します。
    public function user(){

        return $this->belongsTo('App\Models\User');
        
    }


    // use HasFactory;
    protected $fillable = [
        'todo',
        'deadline',
    ];
}
