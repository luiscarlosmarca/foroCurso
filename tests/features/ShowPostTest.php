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

    	$post= factory(\App\Post::class)->make([ //crea el modelo pero no lo guarda en la bd, ps se usa la pichu make

        	'title'		=> 'Como instalar laravel',
        	'content'	=> 'Este es el contenido del past'

        	]);

    	$user->posts()->save($post); //user id al post de forma automatica

    	//when

    	$this->visit(route('posts.show', $post))
    		 ->seeInElement('h1', $post->title)
    		 ->see($post->content)
    		 ->see($post->name);

       
    }
}
