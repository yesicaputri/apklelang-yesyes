<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str; 

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
            'name'             => 'required|min:3|max:30',
            'username'         => 'required|unique:users,username',
            'password'         => 'required|min:8',
            'passwordshow'     => 'required|same:password',
            'telp'             => 'required|numeric'
        ], 
        [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 25 karakter',
            'username.required' => 'Username tidak boleh kosong',
            'username.unique' => 'Username sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'passwordshow.same' => 'Password Harus Sama',
            'telp.required' => 'Telepon tidak boleh kosong',
            'telp.numeric' => 'Telepon harus berupa angka',
        ]
    );

        User::create([
            'name'             => Str::camel($data['name']),
            'username'         => Str::lower($data['username']),
            'password'         => bcrypt($data['password']),
            'passwordshow'     => $data['passwordshow'],
            'level'            => 'masyarakat',
            'telp'             => $data['telp'],
        ]);
        return redirect('/login');

    }
}
