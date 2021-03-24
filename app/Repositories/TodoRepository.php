<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Todo;
use DateTime;

class TaskRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        // モデルのすべてのデータアクセスロジックを保持するを定義する必要があります。
        // これは、アプリケーションが大きくなり、アプリケーション全体でいくつかの
        // Eloquentクエリを共有する
        // 必要がある場合に特に役立ちます。
        
        // $today = new DateTime();

        // return Todo::where('user_id', $user->id)
        //     ->orderByRaw('`deadline` IS NULL ASC')
        //     ->orderBy('deadline')
        //     ->where('deadline', '>=', $today)
        //     ->get();
    }
}
