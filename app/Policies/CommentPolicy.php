<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function accept(User $user, Comment $comment)
    {
        //return $user->id == $comment->post->user_id; **** after theree doritos

        return $user->owns($comment->post);//know if a user is propietario of a post.

    }
}
