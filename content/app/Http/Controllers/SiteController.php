<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
class SiteController extends Controller
{       
    public function index(){
        return view('site.index');
    }

    public function services(){
        return view('site.services');
    }

    public function propos(){
        return view('site.propos');
    }

    public function membre(){
        return view('site.membre');
    }

    public function contact(){
        return view('site.contact');
    }

    public function actualites(){
        return view('site.actualites');
    }

    public function article($slug){
        return view('site.article', compact('slug'));
    }

}
