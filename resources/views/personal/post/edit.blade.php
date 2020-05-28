@extends('layout')

@section('content')
    <div id="app">
        <div class="container">
            <div class="row justify-content-center h-50 wrapper">
                <!--Posting section-->
                <div class="col-md-8 pb-5">
                    <div class="card">
                        <div class="card-body">
                            <label for="post_content">Post something here</label>
                            <textarea class="form-control mb-2"
                                      id="post_content"
                                      name="postarea"
                                      rows="3"
                                      placeholder="What do you want to say?"
                                      form="postform">{{$post->body}}</textarea>
                            <form action="/StayHomeTopic/post/{{ $post->id }}/update" method="POST" enctype="multipart/form-data" id="postform">
                                <div class="form-control-file mr-2">
                                    @if($post->image_post != null)
                                        <img src="images/{{ $post->image_post }}" style="width: 550px" height="400px">
                                    @endif
                                    <label>choose some file to upload</label>
                                    <input class="form-control-file icon fa-file-movie-o" id="image_post"
                                           type="file" name="image_post"
                                           autocomplete="off" value="{{ $post->image_post }}">
                                    @error('image_post')<p style="color: red">{{$message}}</p> @enderror
                                </div>
                                @csrf
                                <button type="submit" class="button primary mt-2">Post</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
