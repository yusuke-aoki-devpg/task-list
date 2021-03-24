<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Todo;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Determine if the given user can delete the given todo.
     *
     * @param  User  $user
     * @param  Todo  $todo
     * @return bool
     */
    public function destroy(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }
}
