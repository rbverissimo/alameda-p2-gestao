<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RaizController extends Controller
{
    public function index(){

        session_start();
        if(isset($_SESSION['email']) && isset($_SESSION['email']) != ''){
            return redirect()->route('painel-principal');
        } else {
            return redirect()->route('login');
        }
    }
}
