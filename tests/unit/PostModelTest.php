<?php

use App\Post;

class PostModelTest extends TestCase
{
    function test_adding_a_title_generates_a_slug()
    {
        $post = new Post([
            'title' => 'Como instalar Laravel'//crear un nuevo post con eloquent
        ]);

        $this->assertSame('como-instalar-laravel', $post->slug);
    }

    function test_editing_the_title_changes_the_slug()// comprueba que cambiar el titulo, cambia el slug
    {
        $post = new Post([
            'title' => 'Como instalar Laravel'
        ]);

        $post->title = 'Como instalar Laravel 5.1 LTS';

        $this->assertSame('como-instalar-laravel-51-lts', $post->slug);//compara que sean iguales.
    }
}