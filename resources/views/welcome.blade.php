@extends('layout')
@section('content')

    <!-- Banner -->
    <section id="banner">

        <div class="inner">
            <h1>Covid-19 Counter <br>
                @auth
                    @if(auth()->user()->user_type == 'admin')
                        (Login as Admin)
                    @endif
                @endauth
            </h1>
            <p>Boring when staying at home due to corona disease outbreak? Come to our website to see our Covid-19 topic.<br /></p>

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
{{--        <video autoplay loop muted playsinline src="images/banner.mp4"></video>--}}
    </section>
    <!-- Testimonials -->
    <section class="wrapper">
        <div class="inner">
            <header class="special">
                <h2>Why Stay Home mean Stay Safe?</h2>
                <p> Covid-19 was not simple as people think, the disease had spreading through out the world and people still hasn't take thing seriously.
                    Because of these, the disease will keep sreading and more people will die. So I made this web to help anyone who have trouble stay at home.
                    Here, we're gathering everyone who have trouble staying at home, sharing ours experience and stories to fight the disease together.
                </p>
            </header>
            <div class="testimonials">
                <section>
                    <div class="content">
                        <blockquote>
                            <p>Don't think of introversion as something that needs to be cured... Spend your free time the way you like, not the way you think you're supposed to. </p>
                        </blockquote>
                        <div class="author">
                            <div class="image">
                                <img src="images/pic01.jpg" alt="" />
                            </div>
                            <p class="credit">- <strong>Susan Cain</strong> <span>	American writer, former lawyer and negotiations consultant</span></p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="content">
                        <blockquote>
                            <p>Home is a shelter from storms—all sorts of storms.</p>
                        </blockquote>
                        <div class="author">
                            <div class="image">
                                <img src="images/pic03.jpg" alt="" />
                            </div>
                            <p class="credit">- <strong>William J. Bennett</strong> <span>Director of the Office of National Drug Control Policy</span></p>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="content">
                        <blockquote>
                            <p>Take care of your body. It’s the only place you have to live in.</p>
                        </blockquote>
                        <div class="author">
                            <div class="image">
                                <img src="images/pic02.jpg" alt="" />
                            </div>
                            <p class="credit">- <strong>Jim Rohn</strong> <span>American entrepreneur, author and motivational speaker.</span></p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    @endsection
