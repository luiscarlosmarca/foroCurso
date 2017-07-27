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

// ************************//////////

	//Validar cuando un usuario quiere acceder y es inivitado. 

	function  test_creating_a_post_requieres_authentication()
	{

//When lo q sucede

		$this->visit(route('posts.create'));

/// Then

		$this->seePageIs(route('login'));  
		
	}

	function test_create_post_form_validation()
	{
		$this->actingAs($this->defaultUser())
			 ->visit(route('posts.create'))
			 ->press('Publicar')
			 ->seePageIs(route('posts.create'))
			 ->seeInElement('#field_title .help-block', 'El campo título es obligatorio')
			 ->seeInElement('#field_content .help-block', 'El campo contenido es obligatorio')
			 //Aquí intentamos iniciar sesion y dar clic en publicar sin completar ningun campo.


	}


}