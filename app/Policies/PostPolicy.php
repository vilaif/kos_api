<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * Policy buat authorization 
 * (biar cuma pemilik yang bisa update/delete)
 */
class PostPolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $posts): bool
    {
        return $user->id === $posts->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $posts): bool
    {
        return $user->id === $posts->user_id;
    }
}