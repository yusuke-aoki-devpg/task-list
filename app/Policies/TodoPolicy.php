<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;
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
     * Determine if the given user can edit the given todo.
     *
     * @param  \App\Models\User $user 
     * @param  \App\Models\Todo $todo 
     * @return mixed
     */
    public function edit(User $user, Todo $todo)
    {
        return $user->id == $todo->user_id;
    }

    /**
     * Determine if the given user can delete the given todo.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Todo  $todo
     * @return bool
     */
    public function destroy(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }
    
}
