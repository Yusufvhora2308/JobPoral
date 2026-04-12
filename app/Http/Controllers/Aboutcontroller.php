<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Aboutcontroller extends Controller
{
    //

    public function About()
    {
        return view('users.About');
    }
}
