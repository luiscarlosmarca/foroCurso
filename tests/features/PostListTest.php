<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Carbon\Carbon;
use App\Post;

class PostListTest extends FeatureTestCase
{
    function test_a_user_can_see_the_posts_list_and_go_to_the_details()
    {
        $post = $this->createPost([
            'title' => '¿Debo usar Laravel 5.3 o 5.1 LTS?'
        ]);
        $this->visit('/')
            ->seeInElement('h1', 'Posts')
            ->see($post->title)
            ->click($post->title)
            ->seePageIs($post->url);// de esta manera probamos que esta bien cuando ve el post, le da clic, y cuando vamos a la ruta.
    }


    function test_the_posts_are_paginated()
    {
        // Having...
        $first = factory(Post::class)->create([
            'title' => 'Post más antiguo',
            'created_at' => Carbon::now()->subDays(2)// crear este post con una fecha anterior para que afecte el orden desc
        ]);
        $posts = factory(Post::class)->times(15)->create([// aqui creamos 15 post con factorys.
            'created_at' => Carbon::now()->subDay()
        ]);
        $last = factory(Post::class)->create([
            'title' => 'Post más reciente',
            'created_at' => Carbon::now()//crear posto reciente
        ]);

        //then
        $this->visit('/')
            ->see($last->title)
            ->dontSee($first->title)// no poder ver el post mas antiguo en la primera pagina  
            ->click('2')
            ->see($first->title)
            ->dontSee($last->title);
    }
}
