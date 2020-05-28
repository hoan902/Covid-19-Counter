@extends('layout')

@section('content')
    <!-- CTA -->
    <section id="cta1" class="wrapper">
        <div class="inner">
            <h2>#Managing user accounts</h2>
            <p>-- For ADMIN only. --</p>
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
                <h1> User List</h1>
                {{-- Search bar--}}
                <div class="col-md-12">
                    <form action="/admin/user" method="get">
                        <div class="input-group-append">
                            <input value="{{$search_user}}" type="search" name="email" class="form-control">
                            <span>
                                <button type="submit" class="button">Search</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="content">
                <table style="width:100%" class="table table-striped">
                    @if ($user != null)
                        <tr>
                            <th>id</th>
                            <th>email</th>
                            <th>Country</th>
                            <th>User Name</th>
                            <th>status</th>
                            <th>action</th>
                        </tr>
                    @else
                    @endif
                    @forelse($user as $users)
                        @if($users->user_type != 'admin')
                            <tr>
                                <td>{{$users->id}}</td>
                                <td>{{ $users->email }}</td>
                                <td>{{ $users->country }}</td>
                                <td>{{ $users->name }}</td>
                                <td @if($users->status == 1)
                                    style="color: limegreen">
                                    @else
                                        style="color: red">
                                    @endif
                                    {{ $users->status ? 'Enabled' : 'Disabled' }}</td>
                                <td>
                                    <form action="/admin/user/{{$users->id}}/destroy" method="POST"
                                          class="float-left">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning"
                                                @if($users->user_type == 'admin')
                                                hidden @endif>Delete account
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @else
                            <h3 class="text-center">There no user account yet</h3>
                        @endif
                    @empty
                        <h3 class="text-center">There no account here</h3>
                    @endforelse
                </table>
            </div>
            <div class="col-12 d-flex justify-content-center pt-4">
                {{ $user->links() }}
            </div>
        </div>
    </section>

@endsection
