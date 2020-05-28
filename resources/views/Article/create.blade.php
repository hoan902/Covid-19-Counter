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
                <h1 class="text-center">Create new articles</h1>
            </div>
            <div class="content row h-50 justify-content-center">
                @auth
                    <div class="col-md-12 pb-5">
                        <div>
                            <div class="card-body">
                                <form action="/Articles" method="POST" enctype="multipart/form-data"
                                      id="postform">
                                    {{--TITLE ZONE--}}
                                    <div>
                                        <label class="label" for="title">Title</label>
                                        <div>
                                            <input class="input-group" type="text" name="title" id="title">
                                        </div>
                                    </div>
                                    @error('title')<p style="color: red">{{$message}}</p> @enderror
                                    {{--EXCERPT ZONE--}}
                                    <div>
                                        <label class="label" for="excerpt">Excerpt</label>
                                        <div>
                                            <input class="input-group" type="text" name="excerpt" id="excerpt">
                                        </div>
                                    </div>
                                    @error('excerpt')<p style="color: red">{{$message}}</p> @enderror
                                    {{--CONTENT ZONE--}}
                                    <label for="body">Content</label>
                                        <textarea class="form-control mb-2"
                                                  id="BodyEditor"
                                                  name="body"
                                                  rows="3"
                                                  placeholder="What do you want to say?"
                                                  form="postform">
                                        </textarea>
                                    @error('body')<p style="color: red">{{$message}}</p> @enderror
                                    {{--TAGS ZONE--}}
                                    <label for="tags">Tags (use ctrl+clicks to choose multiple tags)</label>
                                    <br>
                                    <em>*note: if there no tags you want, you can create your own tag from the articles page</em>
                                    <select class="form-control mb-2" name="tags[]" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                                            @endforeach
                                        </select>
                                    @error('tags')<p style="color: red">{{$message}}</p> @enderror
                                    {{--IMAGE FILE CHOOSE--}}
                                    {{--<div class="form-control-file mr-2">
                                        <label>choose some image to upload</label>
                                        <div>
                                            <input class="form-control-file icon fa-file-image-o" id="image_post"
                                                   type="file" name="image_post"
                                                   autocomplete="off" value="">
                                        </div>

                                        @error('image_post')<p style="color: red">{{$message}}</p> @enderror
                                    </div>--}}
                                    @csrf
                                    <button type="submit" class="button primary mt-2">Create article</button>
                                    <a href="/Articles" class="button"> Back to Articles page</a>
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
