<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Jobs\SendPostEmail;

class PostController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body'  => 'required',
        ]);
        $post = new Post();
        $post->title = $request->title;
        $post->body  = $request->body;
        $post->save();
        // 加入一个队列
        $this->dispatch(new SendPostEmail($post))->delay(now()->addMinutes(5));
    }
}
