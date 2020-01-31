<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the form for login user.
     *
     * @return view
     */
    public function login_view()
    {
        if (Auth::check()) {
            return redirect()->route('post.index');
        }

        return view('admin/user/login');
    }

    /**
     * Authenticate user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $remember = $request->input('remember');
        if (Auth::attempt(['email' => $request->login, 'password' => $request->password], $remember)) {
            return response()->json([
                'status'  => 'success',
                'message' => "Login success"
            ], 200);
        }

        return response()->json([
            'status'  => 'warning',
            'message' => "Wrong password or user login"
        ], 200);
    }

    /**
     * Show the form for logout user.
     *
     * @return view
     */
    public function logout_form()
    {
        return view('admin.users.logout');
    }

    /**
     * Logout user.
     * @return home page
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
