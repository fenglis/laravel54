<?php
namespace App;

use App\Model;

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


}
