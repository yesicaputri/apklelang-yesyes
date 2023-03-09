@extends('templatesb.master')

@section ('content')
<section id="multiple-column-form">
  <div class="row match-height">
      <div class="col-12">
          <div class="card">
              <div class="card-header bg-primary text-white">
                <h4>Tambah Barang</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/barang" method="POST" enctype="multipart/form-data">
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
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><strong>Rp.</strong></span>
                      </div>
                    <input type="text" name="harga_awal" class="form-control" id="harga_awal" placeholder="Harga Awal">
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
                    <label for="deskripsi_barang"> Deskripsi Barang</label>
                    <textarea type="text" name="deskripsi_barang"class="form-control"></textarea>
                  </div>

                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-sm">
                    Submit
                  </button>
                  <div class="modal fade" id="modal-sm">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Tambah Data</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Apa kamu yakin untuk create data ini?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
  
                          <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div style="float: right;"> -->
                  <a href="/barang" class="btn btn-outline-info">Kembali</a>
                  <!-- </div> -->
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