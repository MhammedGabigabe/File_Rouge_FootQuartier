<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModerateurController extends Controller
{
    public function dashboard(){
        return view ('moderateur_dashboard');
    }
}
