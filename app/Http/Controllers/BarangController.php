<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lelang;
use App\Models\User;
use App\Models\HistoryLelang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $barangs = Barang::all();
        return view ('barang.create', compact('barangs'));
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
        $validateData = $request->validate([
            'nama_barang' => 'required',
            'tgl' => 'required',
            'harga_awal' => 'required',
            'image' => 'image|file',
            'deskripsi_barang' => 'required'
        ]);
       
        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('post-images');
        }
        $validateData['users_id'] = Auth::id();
        // Barang::create([
        //     'nama_barang' => $request->nama_barang,
        //     'tgl' => $request->tgl,
        //     'harga_awal' => $request->harga_awal,
        //     'deskripsi_barang' => $request->deskripsi_barang
        // ]);
        Barang::create($validateData);
        return redirect('/barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
        $barangs = Barang::find($barang->id);
        return view('barang.show', compact('barangs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
        $barangs = Barang::find($barang->id);
        return view('barang.edit', compact('barangs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        //
        $rules = [
            'nama_barang' => 'required',
            'tgl' => 'required',
            'harga_awal' => 'required',
            'image' => 'image|file',
            'deskripsi_barang' => 'required',
        ];

        $validateData = $request->validate($rules);
        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('post-images');
        }
        // $barangs = Barang::find($barangs->id);
        // $barangs->nama_barang = Str::lower ($request->nama_barang);
        // $barangs->tgl = $request->tgl;
        // $barangs->harga_awal = $request->harga_awal;
        // $barangs->image = $request->image;
        // $barangs->deskripsi_barang = Str::lower ($request->deskripsi_barang);
        // $barangs->update();

        Barang::where('id', $barang->id)
               ->update($validateData);
        return redirect('/barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        //
        $barangs = Barang::find($barang->id);
        $barangs->delete();

        return redirect('/barang');
    }
}
