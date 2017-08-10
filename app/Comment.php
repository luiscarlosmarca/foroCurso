<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = ['comment','post_id'];
    

    public function post()
    {
    	return $this->belongsTo(Post::class);
    }

    public function markAsAnswer()//mark comment how answer of a post
    {
        $this->post->pending = false;
        $this->post->answer_id = $this->id;
        $this->post->save();
    }
    public function getAnswerAttribute()
    {
        return $this->id === $this->post->answer_id;//condition for comprobar that the answuer of post
    }

}
