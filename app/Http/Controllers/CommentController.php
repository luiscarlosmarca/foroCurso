<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;
use App\Post;

class CommentController extends Controller
{
    public function store (Request $request, Post $post)
    {
    	// $comment = new  Comment([
    	// 	'comment' => $request->get('comment'),
    	// 	'post_id' => $post->id,

    	// 	]);

    	// auth()->user()->comments()->save($comment);

    	//*** 3 doritos despues jajaja, 

    	auth()->user()->comment($post,$request->get('comment'));

    	return redirect($post->url);

    }
}