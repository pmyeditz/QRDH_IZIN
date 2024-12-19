<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HeaderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('components.header', compact('user'));
    }
}
