<?php

use App\Comment;

class AcceptAswerTest extends FeatureTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_posts_author_can_accept_a_comment_as_the_posts_answer()
    {

    	//having
        $comment=factory(Comment::class)->create([
        	'comment' => 'El que va se guardado como respuesta',
        	]);

        $this->actingAs($comment->post->user);

        //when
        $this->visit($comment->post->url)
        	->press('Aceptar como respuesta');

        //then

        $this->seeInDatabase('posts',[

        	'id'=> $comment->post_id,
        	'pending' =>false,
        	'answer_id'=>$comment->id,
        	]);

        $this->seePageIs($comment->post->url)
        	->seeinElement('.answer',$comment->comment);//class css .answer



    }
}
