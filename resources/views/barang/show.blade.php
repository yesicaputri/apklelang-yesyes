@extends('templatesb.master')

@section ('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5 ">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
              @if( $barangs->image )
                  <div class="form-group">
                    <label>Gambar Barang :</label>
                    <br>
                    <img src="{{ asset('storage/' . $barangs->image)}}" alt="{{ $barangs->nama_barang }}" width="68%">
                  </div>
                  @else

                  @endif
              </div>
            </div>
        </div>
        <div class="col-md-7">
              <div class="card card-primary">
              <div class="card-header bg-primary text-white">
                <h4 class="card-title">Detail Page</h4>
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
                    <label for="tgl">Tanggal</label>
                    <input type="date" name="tgl" class="form-control" id="tgl" placeholder="Tanggal" value="{{ $barangs->tgl }}" disabled>
                </div>

                <div class="form-group">
                    <label for="harga_awal">Harga Awal</label>
                    <input type="text" name="harga_awal" class="form-control" id="harga_awal" placeholder="Harga Awal" value="@currency ($barangs->harga_awal)" disabled>
                </div>

                <div class="form-group">
                    <label for="deskripsi_barang">Deskripsi Barang</label>
                    <textarea type="text" name="deskripsi_barang" class="form-control" id="deskripsi_barang" placeholder="Deskripsi Barang" value="" disabled>{{ $barangs->deskripsi_barang }}</textarea>
                </div>

                </select>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                @if(auth()->user()->level == 'petugas')
                <a class="btn btn-primary"href="/barang">Back</a>
                @elseif(auth()->user()->level == 'masyarakat')
                <a class="btn btn-primary"href="/listlelang">Back</a>
                @elseif(auth()->user()->level == 'admin')
                <a class="btn btn-primary"href="/barang">Back</a>
                @endif

                </div>
            </form>      
        </div>
        </div>
</section>
@endsection