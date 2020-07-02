<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required'],
            'password_confirmation' => ['same:password'],
        ]);

        if (User::find($request->id)->update(['password' => Hash::make($request->password_confirmation)])) {
            return response()->json([
                'message' => 'Successfully changed password.'
            ], 200);
        }

        return response()->json([
            'message' => 'Error on changing password'
        ], 500);


    }
}
