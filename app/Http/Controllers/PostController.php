<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::withLikes()->latest()->paginate(15);


        return view('Post.view', compact('posts'));
    }

    /**
     * create the form for creating a new post.
     */
    public function create()
    {
        Request()->validate([
            'postarea' => 'required',
        ]);
            Post::create([
                'body' => request()->postarea,
                'user_id' => auth()->user()->id
            ]);
        return redirect('/StayHomeTopic');
    }

    /**
     * delete the form for creating a new post.
     */
    public function delete(Post $post)
    {
        $post->delete();
        return back();
    }

    /**
     * edit the form for creating a new post.
     *
     */
    public function edit(Post $post)
    {
        return view('Post.edit', compact('post'));
    }

    /**
     * update the form for creating a new post.
     *
     */
    public function update(Post $post)
    {
        Request()->validate([
            'postarea' => 'required',
        ]);
            $post->body = request()->postarea;
            $post->save();
        return redirect('/StayHomeTopic/');
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edi(Post $post)
    {
        //
    }

    /**
     * Store the like of post
     *
     */
    public function store(Post $post)
    {
        $post->like(auth()->user());

        return back();
    }

    /**
     * Remove the like of post
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->dislike(auth()->user());

        return back();
    }
}
