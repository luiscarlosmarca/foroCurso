<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WriteCommentTest extends FeatureTestCase
{
  
   function test_a_user_can_write_a_comment()
    {
 		
    	//Having - teniendo esto
 		$post = $this->createPost(); //crea el post

 		$user = $this->defaultUser(); //crea usuario

 		$this->actingAs($user) //se aseguro de que el usuario creado con el helper defaultUser este contectado
 			->visit($post->url)//visita la url del post creado, la cual se crea con el slug usando este metodo
 			->type('un comentario','comment')//escribe un comentario en el campo comment
 			->press('Publicar comentario');//presiona el boton publicar
    


 		//then- entonces
 		
 		$this->seeInDatabase('comments',[

 			'comment'	=> 'un comentario',
 			'user_id'	=> $user->id,
 			'post_id'	=> $post->id,

	 			]);	

 		// despues 

 		$this->seePageis($post->url);
    }

}
