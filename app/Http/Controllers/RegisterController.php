<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function view()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'             => 'required',
            'username'         => 'required',
            'password'         => 'required',
            'telp'             => 'required'
        ]);

        User::create([
            'name'             => ($data['name']),
            'username'         => ($data['username']),
            'password'         => bcrypt($data['password']),
            'level'            => 'masyarakat',
            'telp'             => $data['telp'],
        ]);
        return redirect('/login');

    }
}
