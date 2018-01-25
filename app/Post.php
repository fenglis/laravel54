<?php
namespace App;

use App\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    protected $guarded = []; //不可注入, 空数组表示所有都可以注入
    //protected $fillable = ['title', 'content']; //允许注入

    public function user()
    {
        //关联操作   数据库  关联的键 被关联的键  id为user表的id
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    //评论模型
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    //和用户进行关联
    public function zan($user_id)
    {
        return $this->hasOne(\App\Zan::class)->where('user_id', $user_id);
    }

    //文章所有赞
    public function zans()
    {
        return $this->hasMany(\App\Zan::class);
    }

    //属于某个作者的文章
    public function scopeAuthorBy(Builder $query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function postTopics()
    {
        return $this->hasMany(\App\PostTopic::class, 'post_id');
    }

    public function scopeTopicNotBy(Builder $query, $topic_id)
    {
        return $query->doesntHave('postTopics', 'and', function($q) use ($topic_id) {
            $q->where("topic_id", $topic_id);
        });
    }
}
