<?php

namespace App\Http\Controllers;

use App\Models\HistoryLelang;
use App\Models\Lelang;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HistoryLelangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $historyLelangs = HistoryLelang::all();
        return view('lelang.datapenawaran', compact('historyLelangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(HistoryLelang $historyLelang, Lelang $lelang)
    {
        //
        $lelangs = Lelang::find($lelang->id);
        $historyLelangs = HistoryLelang::orderBy('harga', 'desc')->get()->where('lelang_id',$lelang->id);
        return view('masyarakat.penawaran', compact('lelangs', 'historyLelangs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, HistoryLelang $historyLelang, Lelang $lelang, Barang $barang)
    {
        //
        $validatedData = $request->validate([
            'harga_penawaran'   => ['required',
            'numeric',
            function ($attribute, $value, $fail) use ($lelang) {
                    if ($value <= $lelang->barang->harga_awal) {
                        $message = "Harga penawaran harus lebih besar dari harga awal yaitu " . "Rp " . number_format($lelang->barang->harga_awal, 0, ',', '.');
                        Alert::error('Error', $message);
                        return $fail($message);
                    }
                },
            ],
        ],
        [
            'harga_penawaran.required'  => "Harus Diisi",
            'harga_penawaran.numeric'   => "Harus Angka",
        ]);

        $historyLelang = new Historylelang();
        $historyLelang->lelang_id = $lelang->id;
        $historyLelang->nama_barang = $lelang->barang->nama_barang;
        $historyLelang->users_id = Auth::user()->id;
        $historyLelang->harga = $request->harga_penawaran;
        $historyLelang->status = 'pending';
        $historyLelang->save();

        return redirect()->route('lelangin.create', $lelang->id);
    }

    public function setPemenang(Lelang $lelang , $id)
    {
    // Mengambil data history lelang berdasarkan id
    $historyLelang = HistoryLelang::findOrFail($id);

    // Mengubah status pada history lelang menjadi 'pemenang'
    $historyLelang->status = 'pemenang';
    $historyLelang->save();

    // Mengambil data lelang berdasarkan history lelang
    $lelang = $historyLelang->lelang;

    // Mengubah status pada lelang menjadi 'ditutup'
    $lelang->status = 'tutup';
    $lelang->pemenang = $historyLelang->user->name;
    $lelang->harga_akhir = $historyLelang->harga;
    $lelang->save();
    return redirect()->back()->with('success', 'Pemenang berhasil dipilih!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HistoryLelang  $historyLelang
     * @return \Illuminate\Http\Response
     */
    public function show(HistoryLelang $historyLelang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HistoryLelang  $historyLelang
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoryLelang $historyLelang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HistoryLelang  $historyLelang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HistoryLelang $historyLelang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HistoryLelang  $historyLelang
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoryLelang $historyLelang)
    {
        //
    }
}
