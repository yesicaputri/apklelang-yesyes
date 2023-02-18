<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lelang;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    //
    public function admin()
    {
        $barangs = DB::table('barangs')->count();
        $lelangs = DB::table('lelangs')->count();
        $users = DB::table('users')->count();
        return view('dashboard.admin')->with(['totalbarang'=>$barangs,'totallelang'=>$lelangs, 'totaluser'=>$users]);
    }
    public function petugas()
    {
        $lelangs = Lelang::all();
        $barangs = DB::table('barangs')->count();
        $lelangs = DB::table('lelangs')->count();
        $users = DB::table('users')->count();
        return view('dashboard.petugas', compact('lelangs'))->with(['totalbarang'=>$barangs,'totallelang'=>$lelangs,'totallelang']);
    }
    public function masyarakat()
    {
        $lelangs = Lelang::all();
        return view('dashboard.masyarakat');
    }
}
