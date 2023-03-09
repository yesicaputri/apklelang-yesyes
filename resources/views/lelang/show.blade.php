@extends('templatesb.master')

@section('content')
<section class="content">
    <div class="container-fluid">
        
        @if(!empty($lelangs))
      <div class="row">
        <div class="col-md-5">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
               @if($lelangs->barang->image)
                <img class="img-fluid mt-3" src="{{ asset('storage/' . $lelangs->barang->image)}}" alt="User profile picture">
                @endif
            </div>
        
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        
        <!-- /.col -->
        <div class="col-md-7">
          <div class="card">
            <div class="card-header bg-primary text-white">
                <ul class="nav nav-pills">
                <h4 class="card-title">Detail Page</h4>
                    
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                @if( Auth::user()->level == 'masyarakat')
                <div class="tab-pane" id="bid">
                    <form class="form-horizontal">
                      <div class="form-group">
                        <label for="inputName">Tawarkan Harga </label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" placeholder="Masukan Harga harus lebih dari {{ $lelangs->harga_akhir }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="">
                          <button type="submit" class="btn btn-danger">Tawarkan</button>
                        </div>
                    </div>
                    </form>
                  </div>
                  @else
                  @endif
                    <div class="card-body">
                    <div class="form-group">
                      <label for="nama_barang">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" id="nama_barang" value="{{ $lelangs->barang->nama_barang}}" disabled>
                    </div>
                    
                    <div class="form-group">
                      <label for="inputEmail">Harga Awal</label>
                        <input type="text" class="form-control" id="inputEmail" value="@currency($lelangs->barang->harga_awal)"disabled>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail">Harga akhir</label>
                        <input type="text" class="form-control" id="inputEmail" value="@currency($lelangs->harga_akhir)"disabled>
                    </div>
                    
                      <div class="form-group">
                        <label for="inputName2">Tanggal Lelang</label>
                          <input type="text" class="form-control" id="inputName2" value="{{ \Carbon\Carbon::parse($lelangs->tanggal_lelang)->format('j F Y')}}" disabled>
                      </div>

                      <div class="form-group">
                        <label for="inputEmail">Status</label>
                            <input type="text" class="form-control" id="inputEmail" value="{{ $lelangs->status}}"disabled>
                      </div>

                      <div class="form-group">
                      <label for="inputEmail">Pemenang Lelang</label>
                         <input type="text" class="form-control" id="inputEmail" value="{{ $lelangs->pemenang}}"disabled>
                    </div>

                    <div class="form-group">
                      <label for="inputExperience">Deskripsi Barang</label>
                        <textarea class="form-control" id="inputExperience" disabled>{{ $lelangs->barang->deskripsi_barang}}</textarea>
                    </div>
                    @if(auth()->user()->level == 'admin')
                      <a href="{{route('lelang.index')}}" class="btn btn-outline-info">Kembali</a>
                        @elseif(auth()->user()->level == 'masyarakat')
                          <a href="{{route('dashboard.masyarakat')}}" class="btn btn-outline-info">Kembali</a>
                        @elseif(auth()->user()->level == 'petugas')
                          <a href="{{ route('lelang.index')}}" class="btn btn-outline-info">Kembali</a>
                    @endif
                  
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        {{-- <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header p-2">
                  <div class="card-body">
    
                </div>
              </div>
            </div>
        </div> --}}
        <!-- /.col -->
      </div>
      @endif
      <!-- /.row -->
    </div><!-- /.container-fluid -->
    <br>
    <div class="card">
      <div class="card-header bg-primary">
        <a href="{{route('cetak.penawaran', $lelangs->id)}}" target="_blank" class="btn btn-info mb-3">
      <li class="fas fa fa-print"></li>
          Cetak Data
        </a>
    </div>
    <div class="card-body table-responsive p-0">
    <table class="table table-hover">
          <thead>
              <tbody>
                  <tr>
                      <th>No</th>
                      <th>Pelelang</th>
                      <th>Nama Barang</th>
                      <th>Harga Penawaran</th>
                      <th>Tanggal Penawaran</th>
                      <th>Status</th>
                      @if(auth()->user()->level == 'petugas')
                      <th></th>
                      @else
                      @endif
                      
                  </tr>
              </tbody>
          </thead>
          @forelse ($historyLelangs as $item)
          <tbody>
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->user->name }}</td>
              <td>{{ $item->lelang->barang->nama_barang }}</td>
              <td>@currency($item->harga)</td>
              <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('j-F-Y') }}</td>
              <td><span class="badge text-white {{ $item->status == 'pending' ? 'bg-warning' : ($item->status == 'gugur' ? 'bg-danger' : 'bg-success') }}">{{ Str::title($item->status) }}</span></td>
              @if(Auth::user()->level == 'petugas')
              @if($item->status == 'pemenang')
            @elseif($item->status == 'gugur')
            @else
            <td>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-sm">
                <i class="fas fa-crown"></i>
            </button>
            @endif
                  <div class="modal fade" id="modal-sm">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Konfirmasi Pemenang Lelang</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Apakah Anda yakin ingin memilih ini sebagai pemenang lelang?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                          <form action="{{ route('lelangpetugas.setpemenang', $item->id) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <button type="submit" class="btn btn-success">Ya, Pilih</button>
                        </div>
                      </div>
                    </div>
                  </div>
              </td>
              @else
              @endif
          </tr>
          @empty
          <tr>
            <td colspan="5" style="text-align: center" class="text-danger"><strong>Belum ada penawaran</strong></td>
          </tr>
          @endforelse
          </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <!-- /.card-footer-->
    </div>  
  </section>
@endsection