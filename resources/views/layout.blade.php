<!DOCTYPE HTML>
<!--
	Project website by Đoàn Nguyên Hoan, Owned by FPT University of Greenwich.
-->
<html>
<head>
    <title>Covid Counter website</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="/assets/css/main.css" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">




    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="is-preload">

<!-- Header -->
<header id="header">
    <a class="logo" href="/">Covid-19 Counter
        @auth
        @if(auth()->user()->user_type == 'admin')
            (Login as Admin)
        @endif
            @endauth
    </a>
    @guest
    <nav>
        <a href="/login">Login</a>
        <a href="/register">Register</a>
        <a href="#menu">Menu</a>
    </nav>
        @else
        <nav>
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <img src="/images/{{ Auth::user()->profile_image }}" style="
                    width: 33px; height:33px; float: none; border-radius: 50%; margin-right: 5px;">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item icon fa-id-card-o" href="/profile">
                        {{ __('Profile') }}
                    </a>
                    <a class="dropdown-item icon fa-sign-out" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            <a href="#menu">Menu</a>
        </nav>
        @endguest
</header>

<!-- Nav -->
<nav id="menu">
    <ul class="links">
        <li><a href="/">Home</a></li>
        <li><a href="/StayHomeTopic">Stay Home Topic</a></li>
        <li><a href="/C19News">Covid News</a></li>
        <li><a href="/Articles">Articles</a></li>
        @auth
            @if(auth()->user()->user_type == 'admin')<li><a href="/admin/user">User Management</a></li>@endif
                <li><a href="/personal/Articles">My Articles</a></li>
                <li><a href="/personal/StayHomeTopic">My Posts</a></li>
        @endauth
    </ul>
</nav>
@yield('content')
<!-- Footer -->
<footer id="footer">
    <div class="inner">
        <div class="content">
            <section>
                <h3>Message from the author</h3>
                <p>My name is Đoàn Nguyên Hoan, i'm the one who create this page. I would like to thanks to TEMPLATED.CO (designed and built by Cherry, Doni, AJ)
                    for providing me free template. Thanks you Jeffrey Way (owner of laracast tutor website forum) with your free laravel teaching video and Coder Tape youtube channel (tutoring with Victor Gonzalez)
                with guiding video about laravel. I would also like to thanks to University of Greenwich for the project sponsor and lesson, thanks to teachers of the FPT Greenwich university
                for teaching me. Thanks to my family and friend who willing to support me both physical and mentally. Thanks you all for your support. </p>
            </section>
            <section>
                <h4>Checkout World Health Organization:</h4>
                <ul class="alt">
                    <li><a href="https://twitter.com/WHO"><i class="icon fa-twitter">&nbsp;</i>Twitter</a></li>
                    <li><a href="https://www.facebook.com/WHO/"><i class="icon fa-facebook">&nbsp;</i>Facebook</a></li>
                    <li><a href="https://www.instagram.com/who/?hl=en"><i class="icon fa-instagram"></i>Instagram</a></li>
                </ul>
            </section>
            <section>
                <h4>Material reference:</h4>
                <ul class="plain">
                    <li><a href="https://www.youtube.com/channel/UCQI-Ym2rLZx52vEoqlPQMdg">Coder Tape youtube channel</a></li>
                    <li><a href="https://laracasts.com/series/laravel-6-from-scratch/episodes/1"> Laracast learn laravel from scratch</a></li>
                    <li><a href="https://templated.co/">Free HTML and Bootstraps template</a></li>
                </ul>
            </section>
        </div>
        <div class="copyright">
            &copy;  FPT University of Greenwich. All rights reserved.
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/browser.min.js"></script>
<script src="/assets/js/breakpoints.min.js"></script>
<script src="/assets/js/util.js"></script>
<script src="/assets/js/main.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'BodyEditor', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>

<!-- Scripts app -->
</body>
</html>
