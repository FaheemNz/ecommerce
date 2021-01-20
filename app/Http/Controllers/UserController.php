<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfileRequest;
use App\Models\User;

class UserController extends Controller
{
    public function edit()
    {
        return view('profile.user-profile')->with('user', auth()->user());
    }

    public function update(UserProfileRequest $userProfileRequest)
    {
        $user = auth()->user();
        $input = request()->except('password', 'password_confirmation');

        if (!request()->filled('password')) {
            $user->fill($input)->save();
            
            return response('', 204);
        }
        
        $user->password = bcrypt($userProfileRequest['password']);
        $user->fill($input)->save();
        
        return response('', 204);
    }
}
