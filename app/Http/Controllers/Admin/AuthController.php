<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Constants;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function getLogin() {
        $this->data['title'] = __('common.login');
        return view('admin.auth.login')->with($this->data);
    }

    public function postLogin(Request$request){
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->has('remember'))) {
            if (Auth::user()->is_visible == Constants::$is_visible['active']){
                notify()->success(trans('users.login_successfully'));
                return redirect(route('admin-home'));
            }else{
                Session::flush();
                notify()->error(trans('users.account_dont_active'));
                return redirect(route('admin.login'));
            }
        }
        notify()->error(trans('users.invalid_credentials'));
        return redirect(route('admin.login'));
    }

    public function logout() {
        Session::flush();
        return redirect(route('admin.login'));
    }
}
