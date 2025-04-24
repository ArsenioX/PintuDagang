<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function signout()
    {
        return view('auth.login');
        Session::flush();
        // Auth::logout();
        // return Redirect('auth.login');
    }
}
