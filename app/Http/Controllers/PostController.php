<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function show(Post $post)
    {
//        dd($post->comments);
        return view('post.show',['post'=>$post]);
    }
    public function edit(Post $post){
        return view('post.edit',['post'=>$post]);
    }

}
