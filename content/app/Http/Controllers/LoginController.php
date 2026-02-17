<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use DB;

class LoginController extends Controller
{
    public function login(){
        /**if (auth()->check()) {
            return redirect()->route('index');
        }**/
        return view('auth.login');
    }

    public function home(){
        return view('home');
    }


    public function verify(){
    	$privilege=Auth::user()->privilege_usr;
        $date=date('Y-m-d');

    	if($privilege=="admin" or $privilege=="vente" or $privilege=="magasin"){
           return redirect()->route('magasin.dashboard');
        }else if($privilege=="directeur"){
            return redirect()->route('magasin.dashboard');
        }else{
        	return 'ERROR';
        }
    }

    public function deconnexion(){
        session()->forget();
        return route('login');
    }
}
