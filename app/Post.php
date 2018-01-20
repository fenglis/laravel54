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
}
