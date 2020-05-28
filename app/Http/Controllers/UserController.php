<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Khsing\World\World;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function profile()
    {
        return view('Profile.profile',array('user' => Auth::user()));
    }
    public function profileEdit(User $userID)
    {
        $countries = World::Countries()->sortBy('name');
        return view('Profile.edit', compact('userID'),compact('countries'));
    }

    public function index(Request $request)
    {
        $this->authorize('AdminAuthorize');
        $search_user = $request->get('email',null);
        if($search_user)
        {
            $user = User::where('email', 'LIKE', '%'.$search_user.'%')->paginate(10);
        }
        else{
            $user = User::latest()->paginate(10);
        }
        return view('admin.user.index',compact('user','search_user'));
    }

    public function destroy(User $user)
    {
        $this->authorize('AdminAuthorize');
        $user->delete();
        return redirect('/admin/user');
    }
}
