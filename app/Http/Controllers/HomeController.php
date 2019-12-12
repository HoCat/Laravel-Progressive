<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = auth()->user()->tasks->all();
        return view('home', ['tasks' => json_encode($tasks)]);
    }

    /*
     *  接收路由参数
     */
    public function req(Request $request, $id)
    {
        dump($request->segments());
        dump($id);
    }
}
