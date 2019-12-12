<?php

namespace App\Http\Controllers;

use App\Jobs\SendPostEmail;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    /*
     * 构建表单页面
     */
    public function form()
    {
        return view('post.form');
    }

    /*
     * 文件上传
     */
    public function submit(Request $request)
    {
        // 判断是否存在文件上传
        if ($request->hasFile('picture')) {
            // 接收文件信息
            $picture = $request->file('picture');
            // 判断文件上传是否有效
            if (!$picture->isValid()) {
                abort(400, '文件无效');
            }
            // 获取文件扩展名
            $extensionName = $picture->getClientOriginalExtension();
            // 获取文件名
            $fileName = $picture->getClientOriginalName();
            // 生成统一格式的文件名
            $newFileName = md5($fileName.time().mt_rand(1, 10000)).'.'.$extensionName;
            // 保存文件
            $savePath = 'images/'.$newFileName;
            // web访问的全路径
            $webPath = '/storage/'.$savePath;
            // 将文件保存到本地 storage/app/public/images 目录下，先判断同名文件是否已经存在，如果存在直接返回
            if (Storage::disk('public')->has($savePath)) {
                return response()->json(['path' => $webPath]);
            }
            // 否则执行保存操作，保存成功将访问路径返回给调用方
            if ($picture->storePubliclyAs('images', $newFileName, ['disk' => 'public'])) {
                return response()->json(['path' => $webPath]);
            }
            abort(500, '文件上传失败');
        }else{
            abort(400, '请选择要上传的文件');
        }
    }
}
