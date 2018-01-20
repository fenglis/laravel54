<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('post/index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('post/show', compact('post'));
    }


    public function create()
    {
        return view('post/create');
    }


    public function store(Request $request)
    {
        //验证
        $this->validate($request, [
            'title' => 'required|string|max:100|min:4',
            'content' => 'required|string|min:10',
        ]);
        //逻辑
        $ret = Post::create(request(['title','content']));

        //渲染
        return redirect('/posts');
    }

    public function edit()
    {
        return view('post/edit');
    }

    public function update()
    {
        return ;
    }

    public function delete()
    {
        return ;
    }

    //图片上传
    public function imageUpload(Request $request)
    {
        dd($request);
    }
}
