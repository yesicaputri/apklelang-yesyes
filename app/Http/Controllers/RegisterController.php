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
            'nama_petugas'     => 'required',
            'username'         => 'required',
            'password'         => 'required',
            'telp'             => 'required'
        ]);

        User::create([
            'nama_petugas'     => ($data['nama_petugas']),
            'username'         => ($data['username']),
            'password'         => bcrypt($data['password']),
            'level'            => 'masyarakat',
            'telp'             => $data['telp'],
        ]);
        return redirect('/login');

    }
}
