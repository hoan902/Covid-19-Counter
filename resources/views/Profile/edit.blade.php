@extends('layout')

@section('content')
    <div class="container">
        <div class="row h-50 justify-content-center">
            <section class="col-md-12 wrapper">
                <div class="col-md-12">
                    <div class="form">
                        <h1 class="text-md-center">{{ auth()->user()->username }} profile edit</h1>
                        <img src="/images/{{ Auth::user()->profile_image }}"
                             style="width: 300px; height:300px; float: left; border-radius: 50%; margin-top: 10px;">
                    </div>
                    <div class="form gtr-uniform">
                        <form method="POST" action="/profile/{{$userID->id}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- Email --}}
                            <div class="form-group row">

                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" placeholder="Enter user email..." type="email" class="form-control " name="email" value="{{ $userID->email }}" required autocomplete="email">

                                </div>
                            </div>
                            {{-- Password --}}
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" placeholder="Enter user password..." type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" placeholder="Re-enter user password..." type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            {{-- Username (not allow to edited) --}}
                            <div class="form-group row" >
                                <label for="username"
                                       class="col-md-4 col-form-label text-md-right">{{ __('User name') }}</label>

                                <div class="col-md-6">
                                    <input id="username" placeholder="Enter user name..." type="text"
                                           class="form-control" name="username"
                                           value="{{ $userID->username }}" required autocomplete="username">

                                </div>
                            </div>
                            {{-- Name --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" placeholder="User full name" type="text"
                                           class="form-control @error('name')
                                               is-invalid @enderror" name="name" required autocomplete="off"
                                           value="{{$userID->name}}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Profile Image --}}
                            <div class="form-group row">
                                <label for="profile_image" class="col-md-4 col-form-label text-md-right">Profile Image
                                    (optional): </label>
                                <div class="col-md-6">
                                    <input class="card" id="profile_image" type="file" name="profile_image"
                                           autocomplete="off" value="{{ $userID->profile_image }}">
                                </div>
                                @error('profile_image')<p style="color: red">{{$message}}</p> @enderror
                            </div>
                            {{-- Country --}}
                            <div class="form-group row">
                                <label for="country"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                                <div class="col-md-6">
                                    <select id="country" type="radio" name="country"
                                            class="form-control @error('country')
                                                is-invalid @enderror" name="country" required autocomplete="off">
                                        <option value="{{$userID->country}}" selected
                                                hidden>{{ $userID->country }}</option>
                                        @foreach($countries as $country)
                                            <option value={{ $country->name }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Phone Number --}}
                            <div class="form-group row">
                                <label for="phone"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="tel" placeholder="Phone number (required 10 number)"
                                           pattern="[0-9]{10}" class="form-control" name="phone" required autocomplete="off"
                                           value="{{$userID->phone}}">


                                </div>
                            </div>
                            {{-- Date of Birth --}}
                            <div class="form-group row">
                                <label for="DoB"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                <div class="col-md-6">
                                    <input id="DoB" type="date" placeholder="User Date of Birth"
                                           class="form-control @error('DoB')
                                               is-invalid @enderror" name="DoB" required autocomplete="off"
                                           value="{{$userID->DoB}}">

                                    @error('DoB')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Gender --}}
                            <div class="form-group row">
                                <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                <div class="col-md-6">
                                    <select id="gender" type="radio" name="gender" class="form-control @error('gender')
                                        is-invalid @enderror" name="gender" required autocomplete="off">
                                        <option value="{{$userID->gender}}" selected
                                                hidden>{{ $userID->gender }}</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="button primary fit">
                                        Update it
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
