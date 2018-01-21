<?php

namespace App;

use App\Model;

class Comment extends Model
{
    //评论所属文章
    public function posts()
    {
        return $this->belongsTo('App\Post');
    }

    //评论用户所属
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
