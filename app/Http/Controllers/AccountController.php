<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AccountController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function profile($username){

        return view('account.profile')->with('account', auth()->user());
    }

    public function update(Request $request, $username)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->user()->id,
        ]);

        $request->user()->name = $request->name;
        $request->user()->email = $request->email;

        $request->user()->save();

        return back()->with('success_status', 'Update saved!');
    }

    public function change_password(Request $request, $username){

        $this->validate($request, [
            'password' => 'required|string|min:8|confirmed'
        ]);

        $request->user()->password = Hash::make($request->password);

        $request->user()->save();

        return back()->with('success_status', 'Password changed!');
    }
}
