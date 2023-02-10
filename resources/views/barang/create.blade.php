@extends('templatesb.master')

@section ('content')
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Barang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/barang" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" id="nama_barang" placeholder="Nama Barang">
                  </div>

                  <div class="form-group">
                    <label for="tgl">Tanggal</label>
                    <input type="date" name="tgl" class="form-control" id="tgl" placeholder="Tanggal">
                  </div>

                  <div class="form-group">
                    <label for="harga_awal">Harga Awal</label>
                    <input type="text" name="harga_awal" class="form-control" id="harga_awal" placeholder="Harga Awal">
                  </div>

                  <div class="form-group">
                    <label for="deskripsi_barang"> Deskripsi Barang</label>
                    <input type="text" name="deskripsi_barang" class="form-control" id="deskripsi_barang" placeholder="Deskripsi Barang">
                  </div>

                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
@endsection