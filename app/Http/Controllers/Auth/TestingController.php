<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestingController extends Controller
{
    //
	function index() {
		return view('auth/siswa/index');
	}
}
