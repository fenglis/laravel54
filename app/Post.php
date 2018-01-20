<?php
namespace App;

use App\Model;

class Post extends Model
{
    protected $guarded = []; //不可注入, 空数组表示所有都可以注入
    //protected $fillable = ['title', 'content']; //允许注入
}
