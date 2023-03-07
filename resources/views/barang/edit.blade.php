@extends('templatesb.master')

@section ('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="form-group">
                    @if( $barangs->image )
                    <img src="{{ asset('storage/' . $barangs->image)}}" alt="{{ $barangs->nama_barang }}" class="img-fluid mt-3">
                    @else
                    <img class="img-preview img-fluid col-sm-5 mb-3" alt="">
                    @endif
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- left column -->
          <div class="col-md-7">
            <!-- general form elements -->
              <div class="card card-primary">
              <div class="card-header bg-primary text-white">
                <h4 class="card-title">Info Edit</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('barang.update', [$barangs->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" name="nama_barang" class="form-control" id="nama_barang" placeholder="Enter Nama Barang" value="{{ $barangs->nama_barang }}" >
                </div>

                <div class="form-group">
                    <label for="tgl">Tanggal</label>
                    <input type="date" name="tgl" class="form-control" id="tgl" placeholder="Enter Tanggal" value="{{ $barangs->tgl }}" >
                </div>

                <div class="form-group">
                    <label>Harga awal</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><strong>Rp.</strong></span>
                      </div>
                      <input type="text" name="harga_awal" value="{{$barangs->harga_awal}}"class="form-control" >
                    </div>
                  </div>

                <div class="form-group">
                    <label for="image" class="form-label">Gambar Barang</label>
                    <img class="img-preview img-fluid col-sm-5 mb-3" alt="">
                    <input class="form-control @error('image')is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                    @error('image')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>

                <div class="form-group">
                    <label for="deskripsi_barang">Deskripsi Barang</label>
                    <textarea type="text-area" name="deskripsi_barang" class="form-control" id="deskripsi_barang" value="">{{ $barangs->deskripsi_barang }}</textarea>
                </div>
                <!-- /.card-body -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-sm">
                    Submit
                  </button>
                  <div class="modal fade" id="modal-sm">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Data</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Apa kamu yakin untuk menyimpan perubahan data ini?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
  
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </form>      
      </div>
    </div>
  </div>
</div>
</section>
<script>
  function previewImage() {
    const image = document.querySelector('#image')
    const imgPreview = document.querySelector('.img-preview')
    imgPreview.style.display = 'block';
    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);
    oFReader.onload = function(oFREvent) {
      imgPreview.src = oFREvent.target.result;
    }
  }
</script>
@endsection