<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        return view('santri.jurusan');
    }
}
