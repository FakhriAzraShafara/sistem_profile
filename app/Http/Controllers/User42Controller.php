<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class User42Controller extends Controller
{
    public function users42()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
        } else {
            $role = null;
        }
        $users = collect(User::where('role', 'User')->get());
        return view('user.users', [
            'no'=>1,
            'users'=>$users->sortBy('is_aktif', false),
            'role'=>$role
        ]);
    }

    public function profile42()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
        } else {
            $role = null;
        }
        return view('user.profile', [
            'role'=>$role
        ]);
    }

    public function detailUser42($id)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
        } else {
            $role = null;
        }

        $user = User::find($id);

        return view('user.detailUser', [
            'user'=>$user,
            'role'=>$role,
        ]);
    }

    // ===aprove user===
    public function approveUser42($id)
    {
        $user=User::find($id);
        $user->is_aktif=true;
        $user->save();

        return redirect('/users42')->with('success','Success Aprove');
    }

    public function deleteUser42($id)
    {
        User::find($id)->delete();
        return redirect('/users42')->with('success', 'Success delete');
    }

    public function login42()
    {
        return view('user.login');
    }

    public function loginProses42(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect('/');
        }
        return redirect('/login42')->with('error','Email or password wrong');
    }

    public function logout42(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function register42()
    {
        return view('user.register');
    }

    public function registerProses42(Request $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'remember_token'=>Str::random(60),
            'foto'=>$request->foto
        ]);

        if ($request->hasFile('foto')) {
            $request->file('foto')->move('img/', $request->file('foto')->getClientOriginalName());
            $user->foto=$request->file('foto')->getClientOriginalName();
            $user->save();
        }


        return redirect('/login42')->with('success','register success');
    }

    public function updatePassword42()
    {
        return view('user.updatePassword');
    }

    public function updatePasswordProses42(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect('/profile42')->with('success','update password success');
    }

}
