<?php

namespace App\Http\Controllers\Pages;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Posts;

class Blog extends Controller
{
    public function index()
    {
        $data = Posts::all();

        return view('blog', ['data' => $data]);
    }

    public function details($id)
    {
        $post = Posts::find($id);

        return view('post', ['post' => $post]);
    }
}
