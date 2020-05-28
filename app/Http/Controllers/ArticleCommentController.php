<?php

namespace App\Http\Controllers;

use App\Article;
use App\ArticleComment;
use Illuminate\Http\Request;

class ArticleCommentController extends Controller
{
    public function getComment(Article $article){
        $ArticleComment = ArticleComment::with('User')->where('article_id',$article->id)->paginate(10);
        return view('Article.detail',compact('ArticleComment','article'));
    }
    public function postComment(Article $article){
        Request()->validate([
            'body' => 'required',
        ]);
        $articles = $article->article_comments()->create([
            'body' => request()->body,
            'user_id' => auth()->user()->id
        ]);
        return back();
    }
    public function edit(Article $article,ArticleComment $comment){
        return view('Article.editCmt', compact('article','comment'));
    }
    public function update(Article $article,ArticleComment $comment){
        Request()->validate([
            'body' => 'required',
        ]);
            $comment->update([
            'body' => request()->body,
            'user_id' => auth()->user()->id
        ]);
        return redirect('/Articles/'.$article->id);
    }

    public function delComment(Article $article,ArticleComment $comment){
        $comment->delete();
        return back();
    }
}
