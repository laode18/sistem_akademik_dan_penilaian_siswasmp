<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use DB;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }else{
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            $user = DB::table('users')->where('email', $request->email)->first();
            if ($user->level == 'admin') {
                return redirect('dashboard');    
            }
            elseif ($user->level == 'guru') {
                return redirect('dashboardguru');   
            }
            elseif ($user->level == 'siswa') {
                return redirect('homesiswa');   
            }
            elseif ($user->level == 'walkes') {
                return redirect('homewalkes');   
            }
            elseif ($user->level == 'ortu') {
                return redirect('homeortu');   
            }
            
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect('/');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}