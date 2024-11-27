<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class SesiController extends Controller
{
    
    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function usercreate()
    {
        return view('admin.user.create');
    }

    public function userindex()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function userstore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alamat' => 'nullable',
        ]);

        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'role' => $request -> role,
        ]);

        if($users){ 
            return redirect()->route('user.index')->with('success', 'User Berhasil Disimpan');
        } else {
            return redirect()->route('createuser')->with('error', 'User Gagal Disimpan');
        }
    }

    public function useredit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function userupdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alamat' => 'nullable',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->alamat = $request->alamat;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with('success', 'User Berhasil Diupdate');
    }

    public function userdelete(User $users)
    {
        $users->delete();

        return redirect()->route('user.index')->with('success', 'User Berhasil Dihapus');
    }

    public function regispost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alamat' => 'nullable',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
        ]);

        Auth::login($user);

        if ($user) {
            return redirect()->route('login')->with('success', 'Register Berhasil Dilakukan');
        } else {
            return redirect()->route('register')->withErrors('Register Gagal Dilakukan Pastikan Semua Data Benar');
        }
    }

    public function loginpost(Request $request)
    {
        $request->validate([
            'email'=>'required|email:dns',
            'password'=>'required',
            'g-recaptcha-response' => 'required|captcha',
        ],[
            'email.required'=>'Email Wajib Diisi',
            'password.required'=>'Password Wajib Diisi',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            session(['last_activity' => time()]);
            if(Auth::user()->role == 'admin' || Auth::user()->role == 'petugas'){
                return redirect()->route('home_admin')->with('success', 'Login Berhasil Dilakukan');
            } else {
                return redirect()->route('home')->with('success', 'Login Berhasil Dilakukan');
            }          
        } else {
            return redirect()->route('login')->withErrors('Login Gagal Dilakukan Pastikan Email Dan Password Benar');
        }
    }

    public function logout(Request $request)
    {
        Cookie::queue(Cookie::forget('user_id'));

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout Berhasil Dilakukan');
    }
}
