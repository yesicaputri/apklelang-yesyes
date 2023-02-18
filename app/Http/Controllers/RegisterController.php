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
            'telepon.required' => 'Telepon tidak boleh kosong',
            'telepon.numeric' => 'Telepon harus berupa angka',
        ]
    );

        User::create([
            'name'             => Str::camel($data['name']),
            'username'         => Str::lower($data['username']),
            'password'         => bcrypt($data['password']),
            'level'            => 'masyarakat',
            'telp'             => $data['telp'],
        ]);
        return redirect('/login');

    }
}
