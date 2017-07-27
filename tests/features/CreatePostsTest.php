<?php

/**
* 
*/
class CreatePostsTest extends FeatureTestCase
{
	
	function test_a_user_create_a_post()
	{
/// having o tenemos
		$user=$this->defaultUser();
		$title='Esta es una pregunta en el campo titulo';
		$content='este es el contenido pichu';
		$this->actingAs($user);
//When lo q sucede

		$this->visit(route('posts.create'))
			->type($title,'title')
			->type($content,'content')
			->press('Publicar'); 

//then entonces.

	   $this->seeInDatabase('posts',[

	   		'title'=>$title,
	   		'content'=>$content,
	   		'pending'=> true, 
	   		'user_id'=> $user->id,

	   	]);//nos ayuda a saber si el registro fue almacenado de forma correcta en la bd. 


//test a user
	   $this->see($title);
	}
}