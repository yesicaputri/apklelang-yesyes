@extends('templatesb.master')

@section ('content')
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Info Edit</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/barang/{{ $barangs->id  }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" id="nama_barang" placeholder="Enter Nama Barang" value="{{ $barangs->nama_barang }}" require>
                    @error('nama_barang')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl">Tanggal</label>
                    <input type="date" name="tgl" class="form-control" id="tgl" placeholder="Enter Tanggal" value="{{ $barangs->tgl }}" require>
                    @error('tgl')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga_awal">Harga Awal</label>
                    <input type="text" name="harga_awal" class="form-control" id="harga_awal" placeholder="Enter Harga Awal" value="@currency ($barangs->harga_awal)" require>
                    @error('harga_awal')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Gambar Barang</label>
                    <input class="form-control @error('image')is-invalid @enderror" type="file" id="image" name="image" value="{{ $barangs->image }}" require>
                    @error('image')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>

                <div class="form-group">
                    <label for="deskripsi_barang">Deskripsi Barang</label>
                    <textarea type="text-area" name="deskripsi_barang" class="form-control" id="deskripsi_barang" value="">{{ $barangs->deskripsi_barang }}</textarea>
                    @error('deskripsi_barang')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                

                <div class="card-footer">
                  <a href="/barang" class="btn btn-primary">
                    {{ __('Submit') }}
                  </a>
                </div>
                
            </form>      
</div>
@endsection