<?php

// Routes that require authentication.


//Posts .
Route::get('post/create',[
	'uses' => 'CreatePostController@create',
	'as'   => 'posts.create'
	]);

Route::post('post/create',[
	'uses' => 'CreatePostController@store',
	'as'   => 'posts.store'
	]);

//Comments


Route::post('posts/{post}/comment',[
	'uses'	=> 'CommentController@store',
	'as'	=> 'comments.store'

	]);


