<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Zan;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->withCount(['comments','zans'])->paginate(6);
        return view('post/index', compact('posts'));
    }

    public function show(Post $post)
    {
        //预加载数据库,避免模板的数据库查询
        $post->load('comments');
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
        $user_id = \Auth::id();
        $params = array_merge(request(['title', 'content']), compact('user_id'));

        $ret = Post::create($params);

        //渲染
        return redirect('/posts');
    }

    public function edit(Post $post)
    {
        return view('post/edit', compact('post'));
    }

    public function update(Post $post)
    {
        //验证
        $this->validate(request(), [
            'title' => 'required|string|max:100|min:4',
            'content' => 'required|string|min:10',
        ]);
        //用户授权认证
        $this->authorize('update', $post);

        //逻辑
        $post->title = \request('title');
        $post->content = \request('content');
        $post->save();
        //渲染

        return redirect("/posts/$post->id");
    }

    public function delete(Post $post)
    {
        //用户授权认证
        $this->authorize('update', $post);

        $post->delete();
        return redirect('/posts');
    }

    //图片上传
    public function imageUpload(Request $request)
    {
        //获取到文件为wangEditorH5File的文件,存储到/public/storage下
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        //到该文件下,找此文件
        return asset('storage/' . $path);
    }

    //评论提交
    public function comment(Post $post)
    {
        //验证
        $this->validate( request(), [
            'content' => 'required|min:3',
        ]);

        //逻辑  模型已经关联
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);
        //渲染
        return back();
    }

    //赞
    public function zan(Post $post)
    {
        $param = [
            'user_id' => \Auth::id(),
            'post_id' => $post->id,
        ];

        Zan::firstOrCreate($param);

        return back();
    }

    //取消赞
    public function unzan(Post $post)
    {
        $post->zan(\Auth::id())->delete();
        return back();
    }
}
