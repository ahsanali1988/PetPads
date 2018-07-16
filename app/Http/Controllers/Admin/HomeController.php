<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller {

    public function __construct() {
        $this->middleware('admin.auth')->except('logout');
    }

    public function index() {
        return view('admin.home.home');
    }

}
