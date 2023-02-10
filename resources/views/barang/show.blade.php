@extends('templatesb.master')

@section ('content')
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Detail Page</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/barang" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" id="nama_barang" placeholder="Nama Barang" value="{{ $barangs->nama_barang }}" disabled>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="Tanggal" value="{{ $barangs->tanggal }}" disabled>
                </div>

                <div class="form-group">
                    <label for="harga_awal">Harga Awal</label>
                    <input type="text" name="harga_awal" class="form-control" id="harga_awal" placeholder="Harga Awal" value="{{ $barangs->harga_awal }}" disabled>
                </div>

                <div class="form-group">
                    <label for="deskripsi_barang">Deskripsi Barang</label>
                    <input type="text" name="deskripsi_barang" class="form-control" id="deskripsi_barang" placeholder="Deskripsi Barang" value="{{ $barangs->deskripsi_barang }}" disabled>
                </div>

                </select>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                <a class="btn btn-primary"href="/barang">Back</a>
                </div>
            </form>      
        </div>
@endsection