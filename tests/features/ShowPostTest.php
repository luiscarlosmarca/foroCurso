<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowPostTest extends FeatureTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
   function test_a_user_can_see_the_post_details()
    {

    	//having
    	$user = $this->defaultUser([
    		'name' => 'Luis Carlos Marin',

    	]);// crea el usuario

    	$post= $this->createPost([ //crea el modelo pero no lo guarda en la bd, ps se usa la pichu make

        	'title'		=> 'Como instalar laravel',
        	'content'	=> 'Este es el contenido del past',
            'user_id'   => $user->id,

        	]);

        //dd(\App\User::all()->toArray());

    	$user->posts()->save($post); //user id al post de forma automatica

    	//when
       
    	$this->visit($post->url)// se modiifica para agregar la url amigable, no vamos a crear una nueva coloumna, basta con usar un atributo dinamico en el modelo post, de eloquent.
    		 ->seeInElement('h1', $post->title)
    		 ->see($post->content)
    		 ->see($post->name)
             ->see('Luis Carlos Marin');

       
    }


    function test_old_urls_are_redirected()// prueba de regresion
    {
        // Having
        
        $post = $this->createPost([// de esta forma creamos el post en el modelo y el base de datos. usando este metodo que esta en el testCase.php
            'title' => 'Old title',
        ]);
      
        $url = $post->url;// guarda la url vieja
        $post->update(['title' => 'New title']);//actualizar el titulo, a su vez la url.
       
        $this->visit($url)
            ->seePageIs($post->url);//si trata de entrar con la url vieja, deberia de mostrar el mismo post actualizado.
    }

}
