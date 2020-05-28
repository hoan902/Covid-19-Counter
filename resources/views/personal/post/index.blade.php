@extends('layout')

@section('content')
    <section id="cta" class="wrapper">
        <div class="inner">
            <h2># My Posts</h2>
            <p>My Post from Stay Home Topic page</p>
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
    <!-- Main -->
    <section id="main" class="wrapper">
        <div class="inner">
            <div class="col-md-12">
                <div id="app">
                    <div class="container h-50">
                        <div class="row justify-content-center">
                            @guest()
                                <h4>Please login or register to Like, make post or comment</h4>
                                <h1 class="text-center"> My Staying Home Post page</h1>
                            @endguest
                        <!--Posting section-->
                            @auth
                                <div class="col-md-8 pb-5">
                                    <h1 class="text-center"> My Staying Home Post page</h1>
                                    <div class="card" style="border:2px; border-style:solid; border-color:#e5e5e5;">
                                        <div class="card-header">Add New Post</div>
                                        <div class="card-body">
                                            <label for="body">Post content here:</label>
                                            <textarea class="form-control mb-2"
                                                      id="BodyEditor"
                                                      name="postarea"
                                                      rows="3"
                                                      placeholder="What do you want to say?"
                                                      form="postform">
                                            </textarea>
                                            @error('postarea')<p style="color: red">{{$message}}</p> @enderror
                                            <form action="/personal/StayHomeTopic/post" method="POST"
                                                  enctype="multipart/form-data" id="postform">
                                                @csrf
                                                <button type="submit" class="button primary mt-2">Post</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                        @else
                        @endauth
                        <!--Posts display section-->
                            <div class="col-md-8 pb-3">
                                <div class="form-group">
                                    <a class="button alert-light btn-group-toggle align-right" href="/personal/StayHomeTopic">
                                        <i class="icon fa-user-circle"> </i> My Post
                                    </a>
                                    <a class="button alert-light btn-group-toggle align-right" href="/StayHomeTopic">
                                        <i class="icon fa-pencil-square-o"> </i> All Post
                                    </a>
                                </div>
                                <div class="card-footer" style="border:2px; border-style:solid; border-color:#e6e6e6;">
                                    <h4 class="text-center"> POST ({{ $posts->count() }})</h4>
                                </div>
                                @foreach($posts as $post)
                                    <div class="card mb-3"
                                         style="border:2px; border-style:solid; border-color:#e7e7e7;">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="mr-2">
                                                        <img class="rounded-circle" width="45"
                                                             src="/images/{{ $post->user->profile_image }}"
                                                             alt="">
                                                    </div>
                                                    <div class="ml-2">
                                                        <div class="h5 m-0">
                                                            @ {{ $post->user->name }}
                                                        </div>
                                                        <div class="h7 text-muted">{{ $post->user->email }}</div>
                                                    </div>
                                                </div>
                                                <div>
                                                    @auth
                                                        @if(auth()->user()->id == $post->user->id)
                                                            <div class="dropdown">
                                                                <button class="btn btn-link dropdown-toggle"
                                                                        type="button" id="gedf-drop1"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-h"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                     aria-labelledby="gedf-drop1">
                                                                    <div class="h6 dropdown-header">Configuration</div>
                                                                    <a class="dropdown-item"
                                                                       href="/post/{{$post->id}}/delete">Delete
                                                                        Post</a>
                                                                    <a class="dropdown-item"
                                                                       href="/personal/StayHomeTopic/post/{{$post->id}}/edit">Edit
                                                                        Post</a>

                                                                </div>
                                                            </div>
                                                        @elseif(auth()->user()->user_type == 'admin')
                                                            <div class="dropdown">
                                                                <button class="btn btn-link dropdown-toggle"
                                                                        type="button" id="gedf-drop1"
                                                                        data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-h"></i>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                     aria-labelledby="gedf-drop1">
                                                                    <div class="h6 dropdown-header">Configuration</div>
                                                                    <a class="dropdown-item"
                                                                       href="/post/{{$post->id}}/delete">Delete
                                                                        Post</a>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endauth
                                                </div>
                                            </div>

                                        </div>

                                        <div class="card border-light mb-1" style="max-width: 60rem;">
                                            <div class="card-body text-dark">
                                                <p class="card-text">{!! $post->body !!}</p>
                                                @if($post->image_post != null)
                                                    <img src="images/{{ $post->image_post }}" style="width: 550px"
                                                         height="400px">
                                                @endif
                                                <p class="card-text"><small class="text-muted">Last updated at <i
                                                            class="fa fa-clock-o"></i>{{$post->updated_at}}</small></p>
                                            </div>
                                            <div class="card-footer bg-transparent border-dark">
                                                <strong class="text-sm text-Blue-500">
                                                    {{ $post->likes ?: 0 }} <i class="icon fa-heart"></i>
                                                </strong>
                                            </div>
                                            @auth
                                                @if($post->isLikedBy(auth()->user())==false)
                                                    <form method="POST" action="/StayHomeTopic/post/{{$post->id}}/like"
                                                          class="card-footer bg-transparent border-dark">
                                                        @csrf
                                                        <button type="submit"
                                                                class="card-link {{ $post->isLikedBy(auth()->user()) ? 'icon fa fa-heart text-blue-400' : ' icon fa fa-heart-o text-gray-400' }}">
                                                            Like
                                                        </button>
                                                    </form>
                                                @elseif($post->isDislikedBy(auth()->user())==false)
                                                    <form method="POST" action="/StayHomeTopic/post/{{$post->id}}/like"
                                                          class="card-footer bg-transparent border-dark">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="card-link {{ $post->isLikedBy(auth()->user()) ? 'icon fa fa-heart text-blue-400' : ' icon fa fa-heart-o text-gray-400' }}">
                                                            Liked
                                                        </button>
                                                    </form>
                                                @endif
                                            @endauth
                                        </div>

                                        <div class="card-footer">
                                            <div class="">
                                                <h4 class="comment-count">COMMENT ({{ $post->comments()->count() }})</h4>
                                                <comment class="comment-count" @auth:currentuser="{{auth()->user()}}"
                                                         @endauth:post="{{$post}}"></comment>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>


                    {{-- <chat :currentuser ="{{ Auth()->user() }}"></chat> --}}
                </div>
            </div>
        </div>
    </section>
    {{--        <script src="http://unpkg.com/turbolinks"></script>--}}


@endsection

