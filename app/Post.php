<?php

namespace App;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $fillable = ['title','content']; 

   public function user()
   {
   	return $this->belongsTo(User::class);
   }
    


public function setTitleAttribute($value)// crea el slug, que sera la url amigable tomando el titulo del post.
   {
    $this->attributes['title'] = $value;
    $this->attributes['slug'] = Str::slug($value);
   }

public function getUrlAttribute()//atributo dinamico url.
  {
    return route('posts.show', [$this->id, $this->slug]);//une el id y el slug.
  }

}
