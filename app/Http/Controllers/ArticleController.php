<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $search_title = $request->get('title',null);
        if(request('tag')){
            $Article = Tag::where('name',request('tag'))->firstOrFail()->articles()->paginate(10);
        }elseif($search_title)
        {
            $Article = Article::where('title', 'LIKE', '%'.$search_title.'%')->paginate(10);
        }
        else{
            $Article = Article::latest()->paginate(10);
        }
        return view('Article.index',compact('Article','search_title'));
    }
//    public function index()
//    {
//        if(request('tag')){
//            $Article = Tag::where('name',request('tag'))->firstOrFail()->articles;
//        }elseif(request('title')){
//            $Article = Article::where('title','like', '%'.request('title').'%')->firstOrFail();
//        }
//        else{
//            $Article = Article::latest()->paginate(15);
//        }
//        return view('Article.index',compact('Article'));
//    }


    public function create()
    {
        $tags = Tag::all();
        return view('Article.create',compact('tags'));
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
    public function store()
    {
        Request()->validate([
            'title' => ' required',
            'excerpt' => ' required',
            'body' => 'required',
            'tags' => 'exists:tags,id'
        ]);
//        if (request()->has('upload')) {
//            $imageUploaded = request()->file('upload');
//            $imageName = time() . '.' . $imageUploaded->getClientOriginalExtension();
//            $imagePatch = public_path('/images/');
//            $imageUploaded->move($imagePatch, $imageName);
//            Article::create([
//                'title' => request()->title,
//                'excerpt' => request()->excerpt,
//                'body' => request()->postarea,
//                'upload_image' => request()->image_post = $imageName,
//                'user_id' => auth()->user()->id
//            ]);
//        } else {
            $article = Article::create([
                'title' => request()->title,
                'excerpt' => request()->excerpt,
                'body' => request()->body,
                'user_id' => auth()->user()->id,
            ]);
            $article->tags() -> attach(request('tags'));
//        }

        return redirect('/Articles');
    }


    public function show(Article $article)
    {
        return view('Article.detail',compact('article'));
    }

    public function edit(Article $article)
    {
        $tags = Tag::all();
        return view('Article.edit', compact('article','tags'));
    }

    public function update(Article $article)
    {
        Request()->validate([
            'title' => ' required',
            'excerpt' => ' required',
            'body' => 'required',
            'tags' => 'exists:tags,id'
        ]);
        $article->update([
            'title' => request()->title,
            'excerpt' => request()->excerpt,
            'body' => request()->body,
            'user_id' => auth()->user()->id,
        ]);
            if(request()->has('tags')){
                    $article->tags() -> sync(request('tags'));
            }
        return redirect('/Articles/'. $article->id);
    }

    public function delete(Article $article)
    {
        $article->delete();
        return redirect('/Articles');
    }


    //TAGS OF ARTICLES
    public function createTag()
    {
        $tags = Tag::latest()->get();
        return view('Tag.createTag',compact('tags'));
    }

    public function storeTag()
    {
        Request()->validate([
            'name' => 'required|unique:tags'
        ]);
        Tag::create([
            'name' => request()->name,
        ]);
        return redirect('/Articles/createTag');
    }

    public function deleteTag(Tag $tag)
    {
        $tag->delete();
        return redirect('/Articles/createTag');
    }
}
