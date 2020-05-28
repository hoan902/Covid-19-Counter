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
            <div>
                <h1 class="text-center">Edit comment id-{{$comment->id}}</h1>
            </div>
            <div class="content row h-50 justify-content-center">
                @auth
                    <div class="col-md-12 pb-5">
                        <div>
                            <div class="card-body">
                                <form action="/Articles/{{$article->id}}/comment/{{$comment->id}}/update" method="POST" enctype="multipart/form-data"
                                      id="postform">
                                    @csrf
                                    @method('PUT')
                                    {{--CONTENT ZONE--}}
                                    <label for="body">Comment content</label>
                                    <textarea class="form-control mb-2"
                                              id="BodyEditor" name="body" rows="3" placeholder="What do you want to say?" form="postform">
                                        {{$comment->body}}
                                    </textarea>
                                    @error('body')<p style="color: red">{{$message}}</p> @enderror
                                    <button type="submit" class="button primary mt-2">Update comment</button>
                                    <a href="/Articles/{{$article->id}}" class="button"> Back to the Article</a>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                @endauth
            </div>
        </div>
    </section>
@endsection
