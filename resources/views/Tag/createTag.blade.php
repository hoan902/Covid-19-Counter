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
                <h1 class="text-center">Manage Tags</h1>
            </div>
            <div class="content row h-50 justify-content-center">
                @auth
                    <div class="col-md-12 pb-5">
                        <div>
                            <div class="card-body">
                                <div>
                                    {{--TAG ZONE--}}
                                    <div class="col-md-12 pb-5">
                                        <table style="width:100%" class="table table-striped">
                                            <h2>Avaliable Tags:</h2>
                                            <tr>
                                                <th>id</th>
                                                <th>Tag Name</th>
                                                <th>Action</th>
                                            </tr>
                                                @foreach($tags as $tag)
                                                    <tr>
                                                        <td>
                                                            <strong>
                                                                {{ $tag->id }}
                                                            </strong>
                                                        </td>
                                                        <td>
                                                            <strong>
                                                                {{ $tag->name }}
                                                            </strong>
                                                        </td>
                                                        <td>
                                                            <strong>
                                                                <form
                                                                    action="/Articles/createTag/{{$tag->id}}/delete"
                                                                    method="POST" class="comment-actions">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="complain">Delete</button>
                                                                </form>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                        </table>
                                    </div>
                                    <form action="/Articles/createTag" method="POST" enctype="multipart/form-data">
                                        <div>
                                            <label class="label" for="name">New Tag name</label>
                                            <div>
                                                <input class="input-group" type="text" name="name" id="name">
                                            </div>
                                            @error('name')<p style="color: red">{{$message}}</p> @enderror
                                        </div>
                                        @csrf
                                        <button type="submit" class="button primary mt-2">Create new Tag</button>
                                        <a href="/Articles" class="button"> Back to Articles page</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                @endauth
            </div>
        </div>
    </section>
@endsection
