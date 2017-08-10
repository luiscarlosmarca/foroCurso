<?php


use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Comment;
use App\Policies\CommentPolicy;
class CommentPolicyTest extends TestCase
{
    
    use DatabaseTransactions;

    function test_the_post_author_can_select_comment_an_answer()
    {

    	 $comment=factory(Comment::class)->create();
        $policy = new CommentPolicy; //Instantiate direct of the class politicy, make in consola. this have that migrate

        $policy->accept($comment->post->user,$comment); //send for parameters the author`s post and comment.

        $this->assertTrue(
        	
        	$policy->accept($comment->post->user,$comment)

        	);
    }


    function test_no_author_cannot_select_comment_an_answer()
    {

    	$comment=factory(Comment::class)->create();
        $policy = new CommentPolicy; 

        $policy->accept($comment->post->user,$comment); 

        $this->assertFalse(
        	
        	$policy->accept(factory(User::Class)->create(),$comment)//send other user, that isn't author's post.

        	);
    }
}
 