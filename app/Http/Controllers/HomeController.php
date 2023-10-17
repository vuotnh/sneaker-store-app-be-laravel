<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('villa.HomeLandingPage');
    }

    public function login() {
        return view('login');
    }

    public function indexAdmin() {
        return view('admin.HomeAdmin');
    }

    public function editUserAdmin() {
        return view('admin.UserEdit');
    }
}
