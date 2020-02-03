<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Helpers\Image\Processing;
use App\Helpers\Output\Response;
use \Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * index view for users datatable
     * 
     * @return view
     */
    public function index()
    {
        return view('admin/user/index');
    }

    /**
     * Data for datatables
     * 
     * @return json
     */
    public function usersData()
    {
        $query = User::select('id', 'name', 'email', 'image');

        return datatables($query)
            ->rawColumns(['action', 'id', 'name', 'email', 'image'])
            ->addColumn('action', 'admin/user/actions')
            ->addColumn('image', 'admin/user/image')

            ->toJson();
    }

    public function avatarUpload($id, Request $request)
    {
        if ($image_name = Processing::uploadBase64($request->avatar, $request->old_big_image ?: '')) {
            $admin = User::find($id);
            $admin->image = $image_name;

            if (!$admin->save()) {
                Response::json_output('Error!', 'Upload error');
            }

            Response::json_output('success', 'success');
        }
    }

    /**
     * Return view for changing avatar
     * 
     * @return view
     */
    public function avatarChange($id)
    {
        $admin = User::find($id);

        return view('admin/user/avatar', ['id' => $id, 'admin' => $admin]);
    }

    /**
     * Return view for changing password
     * 
     * @return view
     */
    public function passwordChange($id)
    {
        return view('admin/user/password', ['id' => $id]);
    }

    /**
     * return response
     * 
     * @return \Illuminate\Http\Response
     */
    public function passwordStore($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password'         => 'required' ,
            'new_password'         => 'min:3|required_with:new_confirm_password|same:new_confirm_password',
            'new_confirm_password' => 'min:3'
        ]);
        
        if ($validator->fails()) {
            Response::json_output('', 'error', ['errors' => $validator->errors()]);
        }

        $admin = User::find($id);

        if (Hash::check($request->old_password, $admin->password)) {
            $admin->password = $request->new_password;

            if (!$admin->update()) {
                Response::json_output('Query error!', 'error');
            }

            Response::json_output('success', 'success');
        }

        Response::json_output('Old password is not correct!', 'error');
    }

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
