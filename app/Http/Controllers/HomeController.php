<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Events\UserEmailUpdated;
use App\Events\UserPasswordChanged;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // user profile view function
    public function profile()
    {
        $data['user'] = Auth::user();
        return view('auth.profile',$data);
    }

    // profile update function
    public function profileUpdate(ProfileRequest $request)
    {
        $profile = Auth::user();
        $old_email = $profile->email;
        $profile->name = $request->name;
        $profile->email = $request->email;
        $status =  $profile->save();
        if($status){
            $user = User::find($profile->id);
            $user['old_email'] = $old_email;
            if($old_email != $request->email){
                event(new UserEmailUpdated($user));
            }
            session()->flash('success', 'Profile updated successfully');
        }else{
            session()->flash('fail', 'Profile update failed');
        }
        return back();
    }

    // password change form show function
    public function passwordChangeForm()
    {
        return view('auth.passwords.change_password');
    }

    // password update function
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'string', 'min:8'],
            'password_confirmation' => ['required','same:new_password'],
        ]);
        User::find(Auth::user()->id)->update(['password'=> Hash::make($request->new_password)]);
        session()->flash('success', 'Password updated successfully');
        event(new UserPasswordChanged(Auth::user()));
        return back();
    }
}
