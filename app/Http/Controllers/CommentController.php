<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getComment(Post $post){
        $test = Comment::with('User')->where('post_id',$post->id)->withLikeComments()->get();
        return $test;
    }
    public function postComment(Post $post){
        $posts = $post->Comments()->create([
            'body' => request()->body,
            'user_id' => auth()->user()->id
        ]);
        return $posts;
    }
    public function delComment(Post $post,Comment $comment){
        $comment->delete();
    }

    /*
     * like a comment
     */
    public function store(Post $post, Comment $comment)
    {
        $comment->likecmt(auth()->user());
        return back();
    }
    /**
     * dislike a comment
     */
    public function destroy(Post $post, Comment $comment)
    {
        $comment->dislikecmt(auth()->user());

        return back();
    }
}
