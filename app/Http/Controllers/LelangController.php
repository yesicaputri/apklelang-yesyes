<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lelang;
use App\Models\HistoryLelang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LelangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lelangs = Lelang::all();
        $barangs = Barang::select('id', 'nama_barang', 'harga_awal')
                    ->whereNotIn('id', function($query)
                    {
                        $query->select('barangs_id')->from('lelangs');
                    })->get();
        return view('lelang.index', compact('lelangs', 'barangs'));
    }

    public function cetaklelang()
    {
        //
        $cetaklelangs = Lelang::all();
        return view('lelang.cetaklelang', compact('cetaklelangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $barangs = Barang::select('id', 'nama_barang', 'harga_awal')
                    ->whereNotIn('id', function($query)
                    {
                        $query->select('barangs_id')->from('lelangs');
                    })->get();
        return view('lelang.create', compact('barangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'barangs_id'         => 'required|exists:barangs,id|unique:lelangs,barangs_id',
                'tanggal_lelang'    => 'required|date',
            ],
            [
                'barang_id.required'        => 'Barang Harus Diisi',
                'barang_id.exists'          => 'Barang Tidak Ada Pada Data Barang',
                'barang_id.unique'          => 'Barang Sudah Di Lelang',
                'tanggal_lelang.required'   => 'Tanggal Lelang Harus Diisi',
                'tanggal_lelang.date'       => 'Tanggal Lelang Harus Berupa Tanggal',
            ]);
        $lelang = new Lelang;
        $lelang->barangs_id = $request->barangs_id;
        $lelang->tanggal_lelang = $request->tanggal_lelang;
        $lelang->harga_akhir = '0';
        $lelang->pemenang = 'Belum Ada';
        $lelang->users_id = Auth::user()->id;
        $lelang->status = 'dibuka';
        $lelang->save();

        return redirect('/lelang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function show(Lelang $lelang)
    {
        //
        $historyLelangs = HistoryLelang::orderBy('harga', 'desc')->get()->where('lelang_id',$lelang->id);
        $lelangs = Lelang::find($lelang->id);
        return view('lelang.show', compact('lelangs','historyLelangs'));
    }

    public function cetakpenawaran(Lelang $lelang, $status = null)
    {
    $lelangs = Lelang::find($lelang->id);
    
    if($status == 'pemenang'){
        $historyLelangs = HistoryLelang::orderBy('harga', 'desc')->where('lelang_id',$lelang->id)->where('status', 'pemenang')->get();
    } elseif($status == 'pending') {
        $historyLelangs = HistoryLelang::orderBy('harga', 'desc')->where('lelang_id',$lelang->id)->where('status', 'pending')->get();
    } elseif($status == 'gugur') {
        $historyLelangs = HistoryLelang::orderBy('harga', 'desc')->where('lelang_id',$lelang->id)->where('status', 'gugur')->get();
    } else {
        $historyLelangs = HistoryLelang::orderBy('harga', 'desc')->where('lelang_id',$lelang->id)->get();
    }
    
    return view('lelang.cetakdatapenawaran', compact('lelangs','historyLelangs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function edit(Lelang $lelang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lelang $lelang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lelang  $lelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lelang $lelang)
    {
        //
        // $lelangs = Lelang::find($lelang->id);

        // if ($lelangs) {
        //     $lelangs->delete();
        //     return redirect()->route('lelangpetugas.index');
        // } else {
        //     return redirect()->route('lelangpetugas.index');
        // }
        
    }

    public function listlelang(Lelang $lelang)
    {
        $lelangs = Lelang::all();
        return view('listlelang.index', compact('lelangs'));
    }

    public function masyarakatList(Lelang $lelang)
    {
         //
         $lelangs = Lelang::select('id', 'barangs_id', 'tanggal_lelang', 'harga_akhir', 'status')
         ->get();
         return view('masyarakat.lelang_list', compact('lelangs'));
    }
}
