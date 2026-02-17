<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;

class PasswordController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
       
    public function mot_de_passe(){
        return view('admin.password_change');
    }

    public function mot_de_passe_reset(Request $request){
        $user=auth()->user()->id;
        $old= $request->input('old_pwd');
        $new= $request->input('new_pwd');
        $confirm= $request->input('confirme_pwd');

        if($new!=$confirm){
            return redirect()->route('mot_de_passe')->with('error','Les deux Mot de Passe doivent correspondre');
        }

        $check  = DB::table('users')->where('id','=',$user)->get('password');
        $pd=$check[0]->password;

        if(Hash::check($old, $pd)){
            DB::update('update users set password = ? where id = ?', [Hash::make($new) ,$user]);
            Auth::logout();
            return redirect()->route('authentification')->with('ok','Veuillez vous reconnecter !');
        }else{
            return redirect()->route('mot_de_passe')->with('error','Ancien Mot de Passe incorrecte !');
        }


    }
}
