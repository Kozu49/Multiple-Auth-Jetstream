<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MainAdminController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
