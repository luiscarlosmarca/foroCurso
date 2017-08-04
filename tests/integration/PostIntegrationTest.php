<?php

use App\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends TestCase
{
    use DatabaseTransactions;

    function test_a_slug_is_generated_and_saved_to_the_database()
    {
        $user = $this->defaultUser();// crear usuario

        $post = factory(Post::class)->make([// crear un post con factory solo con modelos
            'title' => 'Como instalar Laravel',
        ]);

        $user->posts()->save($post); //guarda el post a la base de datos, con los modelos.

        $this->assertSame(
            'como-instalar-laravel',
            $post->fresh()->slug//metodo fresh, carga de nuevo el modelo para probara q se actualice bien.
        );

        /*
                $this->seeInDatabase('posts', [
                    'slug' => 'como-instalar-laravel'
                ]);

                $this->assertSame('como-instalar-laravel', $post->slug);
        */
    }

    function test_generated_url_of_post_shows_the_post()//pruebas las url creadas con el set url
    {
        $user = $this->defaultUser();
        $post = factory(Post::class)->make();
        $user->posts()->save($post);

        $this->visit($post->url)
            ->seePageIs($post->url)
            ->see($post->title);
    }
}