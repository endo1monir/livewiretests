<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'comment' => 'required|min:4'
        ]);
        Comment::create([
            'post_id'=>$post->id,
            'username'=>'Guest',
            'content'=>$data['comment']
        ]);
        return back()->with('success_message','Comment was posted!');
    }
}
