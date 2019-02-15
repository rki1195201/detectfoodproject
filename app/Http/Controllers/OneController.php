<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class OneController extends Controller
{
    public function __invoke($id){
        return view('home',['user' => User::findOrFail($id)]);
    }
}
