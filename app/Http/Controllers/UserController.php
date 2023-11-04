<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function profile() {
        $user = Auth::user();
        return view('profile',compact('user'));
    }

    public function updateInfo(Request $request) {

        $userId = Auth::id();

        $validatedData = $request->validate(
            [
                'name' => 'required|string|min:4|max:50',
                'email' => 'required|email|unique:users,email,' . $userId,
                'username' => 'required|min:8|max:25|unique:users,username,' . $userId,
                'bio' => 'max:200',
                'mobile' => 'max:10',
            ]
        );

        $validatedData['bio'] = trim($validatedData['bio']);
        $validatedData['date_of_birth'] = $request->date_of_birth;
        $validatedData['gender'] = $request->gender;

        $updatedUser = Auth::user()->update($validatedData);

        if($updatedUser) {
            return  redirect()->to('/profile')->with([
                'successInfo' => 'Info Updated Successfully'
            ]);
        }

        return abort(500);

    }


    public function updatePassword(Request $request) {


        $validatedData = $request->validate([
            'current_password' => 'required|min:8',
            'new_password'=> 'required|confirmed',
            'new_password_confirmation' => 'required'
        ]);


        $user = auth()->user();

        if(!Hash::check($validatedData['current_password'],$user['password'])) {
             return  redirect()->to('/profile')->with([
                 'failedPassword' => 'Wrong Current Password'
             ]);
        }

        $user['password'] = bcrypt($validatedData['new_password']);

        if($user->save()) {
            return  redirect()->to('/profile')->with([
                'successPassword' => 'Password Updated Successfully'
            ]);
        }

        abort(500);
    }

}
