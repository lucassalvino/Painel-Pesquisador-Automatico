<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\User;
use App\Utils\BaseRetornoApi;
use Illuminate\Http\Request;

class AdminController extends Controller{

    public function index(){
        return view('pages.home');
    }
    public function Politica(){
        return view ('pages.politica');
    }
    public function Sobre(){
        return view ('pages.sobre');
    }
    public function EmConstrucao(){
        return view ('pages.emconstrucao');
    }
}