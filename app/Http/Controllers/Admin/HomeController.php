<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show admin dashboard
     *
     * @return Illuminate\Http\Response
     */
    public function index() {
        return view('admin.home');
    }
}
