@extends('layout')

@section('content')
    <!-- CTA -->
    <section id="cta1" class="wrapper">
        <div class="inner">
            <h2>#Personal Articles </h2>
            <p>Your personal articles.</p>
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
            <div>
                <h1>My Articles List</h1>
                {{-- Search bar--}}
                <div class="col-md-12">
                    <form action="/personal/Articles" method="get">
                        <div class="input-group-append">
                            <input value="{{$search_title}}" type="search" name="title" class="form-control" >
                            <span>
                                <button type="submit" class="button">Search</button>
                            </span>
                        </div>
                    </form>
                </div>
                @auth
                    <div class="form-group">
                        <a class="button alert-secondary btn-group-toggle" href="/personal/Articles/create">
                            Create new article
                        </a>
                        <a class="button alert-secondary btn-group-toggle" href="/personal/Articles/createTag">
                            Create new tag for articles
                        </a>
                    </div>
                    <div class="form-group">
                        <a class="button alert-light btn-group-toggle align-right" href="/personal/Articles">
                            <i class="icon fa-user-circle"> </i> My Articles
                        </a>
                        <a class="button alert-light btn-group-toggle align-right" href="/Articles">
                            <i class="icon fa-pencil-square-o"> </i> All Articles
                        </a>
                    </div>
                @endauth
            </div>
            <div class="content" style="border:1px; border-style:solid; border-color:#8f8f8f; padding: 1em;">
                @forelse($Article as $articles)
                    <div class="box-content" style="border:1px; border-style:solid; border-color:#000000; padding: 1em">
                        <header>
                            <a href="/Articles/{{$articles->id}}"><h2>{{ $articles->title }}</h2></a>
                        </header>
                        <p>Excerpt: {{ $articles->excerpt }}</p>
                        <em class="text-right inline"><i class="icon fa-user-circle"> </i> Author: {{$articles->user->name}}</em>
                        <br>
                        <em><i class="icon fa-clock-o"> </i> created at: {{$articles->created_at->toDateString()}}</em>
                        <br>
                        <header><i class="icon fa-tags">
                            </i> Tag: @foreach($articles->tags as $tag) <a href="/personal/Articles?tag={{$tag->name}}">{{ $tag->name }}</a>,  @endforeach
                        </header>
                        <hr/>
                    </div>
                    <br>
                @empty
                    <h3 class="text-center">Sorry, No relevant article was written yet, please comeback later</h3>
                @endforelse
            </div>
            <div class="col-12 d-flex justify-content-center pt-4">
                {{ $Article->links() }}
            </div>
        </div>
    </section>

@endsection
