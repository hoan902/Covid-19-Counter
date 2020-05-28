@extends('layout')

@section('content')
<div id="app">
    <div class="container">
        <div class="row justify-content-center h-50 wrapper">
            <!--Posting section-->
            <div class="col-md-8 pb-5">
                <div class="card">
                    <div class="card-body">
                        <label for="postarea">Post something here</label>
                        <textarea class="form-control mb-2"
                                  id="BodyEditor"
                                name="postarea"
                                rows="3"
                                placeholder="What do you want to say?"
                                form="postform">{{$post->body}}</textarea>
                        <form action="/StayHomeTopic/post/{{ $post->id }}/update" method="POST" enctype="multipart/form-data" id="postform">
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
