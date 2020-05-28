@extends('layout')
@section('content')
    <section id="cta1" class="wrapper">
        <div class="inner">
            <h2>#Articles about COVID-19 Topic</h2>
            <p>Find articles about any topic you want, share your knowledge with others.</p>
            <div>
                <nav>
                    <ul>
                        <li><a href="/StayHomeTopic"><i class="icon fa-gamepad">&nbsp;</i>Stay Home Topic |</a></li>
                        <li><a href="/C19News"><i class="icon fa-book">&nbsp;</i>Links for Covid-19 News |</a></li>
                        <li><a href="/Articles"><i class="icon fa-pencil-square-o">&nbsp;</i>Articles |</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <section id="main" class="wrapper">
        <div class="inner">
            <div class="card">
                <div class="card-header">
                    <img class="rounded-circle" width="45"
                         src="/images/{{ $article->user->profile_image }}"
                         alt=""> @ {{ $article->user->name }}
                    <header>
                        <i class="icon fa-clock-o"> </i> created on {{ $article->created_at->toDateString() }}</header>
                    <header><i class="icon fa-tags">
                        </i> Tag: @foreach($article->tags as $tag) <a
                            href="/Articles?tag={{$tag->name}}">{{ $tag->name }}</a>   @endforeach
                    </header>
                    @if(auth()->user()== $article->user)
                        <div class="boxed-btn">
                            <footer><i class="icon fa-edit"> </i><a class="btn-link" href="/Articles/{{$article->id}}/edit">Edit article</a></footer>
                            <form action="/Articles/{{$article->id}}/delete" method="POST" id="myForm">
                                @csrf
                                @method('DELETE')
                                <div><button class="btn-link" type="submit"><i class="icon fa-trash-o"> </i>Delete article</button></div>
                            </form>
                        </div>
                        @elseif(auth()->user()->user_type == 'admin')
                        <div class="boxed-btn">
                            <form action="/Articles/{{$article->id}}/delete" method="POST" id="myForm">
                                @csrf
                                @method('DELETE')
                                <div><button class="btn-link" type="submit"><i class="icon fa-trash-o"> </i>Delete article</button></div>
                            </form>
                        </div>
                        @else
                    @endif
                </div>
                <div class="card-body">
                    <h1 class="text-center" style="font-weight: bolder;font-size: 45px">{{ $article->title}}</h1>
                    <div class="content row h-50 justify-content">
                        <div class="inner-padding">
                            <article>
                                {!! $article->body !!}
                            </article>
                        </div>
                    </div>
                </div>
            </div>
            {{--            <h4 class="comment-count">COMMENT ({{ $article->article_comments->count() }})</h4>--}}

            <div class="comments-area card card-footer">
                <h4 class="comment-count">COMMENT (
                    @if($article->article_comments->count() === null)
                        0)
                    @else
                        {{ $article->article_comments->count()}})
                    @endif
                </h4>
                <div class="content row h-50 justify-content col-md-12">
                    <div class="inner-padding col-md-12">
                        <article>
                            @foreach($ArticleComment as $comment)
                                <div class="comment-block mb-2">
                                    <div class="card">
                                        <div class="card-header form-inline">
                                            <div class="mr-2">
                                                <img class="rounded-circle" width="45"
                                                     src="/images/{{ $comment->user->profile_image }}"
                                                     alt="">
                                            </div>
                                            <div class="ml-2">
                                                <div class="h5 m-0">@ {{$comment->user->name}}</div>
                                                <div class="h7 text-muted">{{ $comment->user->email }}</div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="comment-text">{!!  $comment->body !!}</p>
                                            <div class="bottom-comment">
                                                <div class="comment-date"> <i class="icon fa-clock-o"> </i>{{ $comment->created_at }}</div>
                                                @auth
                                                    @if(auth()->user() == $comment->user )
                                                        <form
                                                            action="/Articles/{{$comment->article->id}}/comment/{{$comment->id}}/delete"
                                                            method="POST" class="comment-actions">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="complain">Delete</button>
                                                            <a class="button" href="/Articles/{{$comment->article->id}}/comment/{{$comment->id}}/edit">Edit</a>
                                                        </form>
                                                    @elseif(auth()->user()->user_type == 'admin')
                                                        <form
                                                            action="/Articles/{{$comment->article->id}}/comment/{{$comment->id}}/delete"
                                                            method="POST" class="comment-actions">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="complain">Delete</button>
                                                        </form>
                                                        @else
                                                    @endif
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </article>
                    </div>
                    <div class="col-12 d-flex justify-content-center pt-4">
                        {{ $ArticleComment->links() }}
                    </div>
                </div>
                @auth
                    <form action="/Articles/{{$article->id}}/comment/submit" method="POST" enctype="multipart/form-data" class="card">
                        @csrf
                        <div class="card-header form-inline">
                            <div class="mr-2">
                                <img class="rounded-circle" width="45"
                                     src="/images/{{ auth()->user()->profile_image }}"
                                     alt="">
                            </div>
                            <div class="ml-2">
                                <div class="h5 m-0">@ {{auth()->user()->name}}</div>
                                <div class="h7 text-muted">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" type="text" placeholder="Comment here"
                                   name="body" id="BodyEditor">
                            </textarea>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="button primary mt-2" style="float:right" onclick="myFunction()">Submit</button>
                        </div>
                    </form>
                @endauth
            </div>
            <a href="/Articles" class="button"> Back to Articles page</a>
            <a href="/personal/Articles" class="button"> Back to My Articles page</a>
        </div>
    </section>
@endsection
