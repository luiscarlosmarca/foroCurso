<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
 
class CreatePostController extends Controller
{
 
	public function create()
	{
		return view('posts.create');
	}

	public function store(Request $request)
	{
		//$post=Post::create($request->all());

		$this->validate($request,[

			'title'   => 'required',
			'content' => 'required',

			]); //Validación rapida, y laravel se encarga de regresar a la pantalla anterior.

		$post= new Post ($request->all()); //instanciar un nuevo post

		auth()->user()->posts()->save($post);// se lo asignamos al usuario que esta conectado.


		return "Post: ".$post->title;
	}
    //
}
