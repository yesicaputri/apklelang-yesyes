<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lelang;
use App\Models\Barang;
use App\Models\User;
use App\Models\HistoryLelang;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    //
    public function admin()
    {
        $barangs = DB::table('barangs')->count();
        $lelangs = DB::table('lelangs')->count();
        $users = DB::table('users')->count();
        $history_lelangs = DB::table('history_lelangs')->count();
        return view('dashboard.admin')->with(['totalbarang'=>$barangs,'totallelang'=>$lelangs, 'totaluser'=>$users,'totalpenawaran'=>$history_lelangs]);
    }
    public function petugas()
    {
        $lelangs = Lelang::all();
        $barangs = DB::table('barangs')->count();
        $lelangs = DB::table('lelangs')->count();
        $users = DB::table('users')->count();
        $history_lelangs = DB::table('history_lelangs')->count();
        return view('dashboard.petugas', compact('lelangs'))->with(['totalbarang'=>$barangs,'totallelang'=>$lelangs,'totalpenawaran'=>$history_lelangs]);
    }
    public function masyarakat(Lelang $lelang)
    {
        $lelangs = Lelang::all();
        return view('dashboard.masyarakat',compact( 'lelangs'));
    }
}
