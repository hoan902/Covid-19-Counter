@extends('layout')
@section('content')
    <!-- CTA -->
    <section id="cta2" class="wrapper">
        <div class="inner">
            <h2>#Listing of Covid-19 News reliable website</h2>
            <p>Still worried about the outbreak status? Here are some reliable links for Corona virus news to catch up with.</p>
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
            <div class="content">
                @auth
                @if(auth()->user()->user_type == 'admin')
                    <form action="/C19News" method="POST" enctype="multipart/form-data">
                        <h1>Add new website link</h1>
                        <div>
                            <label class="label" for="web_name">Website name</label>
                            <div>
                                <input class="input-group" type="text" name="web_name" id="web_name" placeholder="Enter the name of the web page">
                            </div>
                            @error('web_name')<p style="color: red">{{$message}}</p> @enderror
                            <br>
                            <label class="label" for="url">Website URL</label>
                            <div>
                                <input class="input-group" type="text" name="url" id="url" placeholder="Copy whole url from the browser (had to have https://)">
                            </div>
                            @error('url')<p style="color: red">{{$message}}</p> @enderror
                        </div>

                        @csrf
                        <button type="submit" class="button primary mt-2">Add</button>
                    </form>
                    @endif
                @endauth
                <h1>List of Links for Corona virus news</h1>
                    <table style="width:100%" class="table table-striped">
                        <tr>
                            <th>id</th>
                            <th>Website Name</th>
                            <th>Website link</th>
                            @auth
                            @if(auth()->user()->user_type == 'admin')
                                <th>Action</th>
                            @endif
                                @endauth
                        </tr>
                    @forelse($Websites as $website)
                        <tr>
                            <td>
                                <strong>
                                    {{ $website->id }}
                                </strong>
                            </td>
                            <td>
                                <strong>
                                    {{ $website->web_name }}
                                </strong>
                            </td>
                            <td>
                                <a href="{{$website->url}}">
                                    {{ $website->url }}
                                </a>
                            </td>
                            @auth
                            @if(auth()->user()->user_type == 'admin')
                                <td>
                                    <strong>
                                        <form
                                            action="/C19News/{{$website->id}}/delete"
                                            method="POST" class="comment-actions">
                                            @csrf
                                            @method('DELETE')
                                            <button class="complain">Delete</button>
                                        </form>
                                    </strong>
                                </td>
                            @endif
                                @endauth
                        </tr>
                        @empty
                            <p>No Website link available yet, pls contact admin to request for more links</p>
                    @endforelse
                    </table>
            </div>
        </div>
    </section>
@endsection
