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
        return view('post.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('post.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'photo' => 'nullable|image|sometimes|max:5000'
        ]);
        $post->update([
                'title' => $request->title,
                'content' => $request->title,
                'photo' => $request->photo ? $request->file('photo')->store('photos', 'public') : $post->photo
            ]
        );
        return back()->with('success_message', 'Post updated successfully');
    }
}
