<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Khsing\World\World;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('Profile.profile');
    }
    public function profileEdit(User $userID)
    {
        $countries = World::Countries()->sortBy('name');
        return view('Profile.edit', compact('userID'),compact('countries'));
    }
    //Update the specified student in storage.
    public function updateProfile( User $userID)
    {
       $atribu = Request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'string',
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($userID),
            ],
            'username' => [
                'string',
                'required',
                'max:255',
                'alpha_dash',
                Rule::unique('users')->ignore($userID),
            ],
            'password' => ['string',
                'required',
                'min:8',
                'max:255',
                'confirmed',],
            'country' => ['required'],
            'phone' => ['required',Rule::unique('users')->ignore($userID)],
            'DoB' => 'required|date',
            'gender' => 'required',
        ]);
        if(request()->has('profile_image')) {
            $imageUploaded = request()->file('profile_image');
            $imageName = time() . '.' . $imageUploaded->getClientOriginalExtension();
            $imagePatch = public_path('/Images/');
            $imageUploaded->move($imagePatch, $imageName);
            $userID -> profile_image = $imageName;
            $userID->update($atribu);
            $userID->password = Hash::make($atribu['password']);
            $userID->save();
//            return redirect('/profile/'.$userID->id);
        }else{
            $userID->update($atribu);
            $userID->password = Hash::make($atribu['password']);
            $userID->save();
//            return redirect('/profile/'.$userID->id);
        }
        return redirect('/profile');
    }
}
