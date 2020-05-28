@extends('layout')
@section('content')
    <div class="container">
        <div class="row h-50 justify-content-center wrapper">
            <div class="form-text text-center">
                    <div class="list-group">
                        <img src="/images/{{ Auth::user()->profile_image }}" style="width: 150px; height:150px; float: left; border-radius: 50%; margin-right: 25px;">
                        <h1>{{ Auth::user()->name }}</h1>
                    </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ Auth::user()->username }} PROFILE</div>

                    <div class="card-body">
                            <strong>Name</strong>
                            <p>{{ Auth::user()->name }}</p>

                            <strong>Email</strong>
                            <p>{{ Auth::user()->email }}</p>

                            <strong>country</strong>
                            <p>{{ Auth::user()->country }}</p>

                            <strong>phone</strong>
                            <p>{{ Auth::user()->phone }}</p>

                            <strong>Day Of Birth</strong>
                            <p>{{ Auth::user()->DoB }}</p>

                            <strong>Gender</strong>
                            <p>{{ Auth::user()->gender }}</p>
                        <div>
                            <a data-animation="fadeInLeft" data-delay="1.0s" class="button primary" href="/profile/{{Auth::user()->id}}/edit">Edit profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
