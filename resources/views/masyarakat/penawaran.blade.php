@extends('templatesb.master')

@section('content')
<div class="card">
@if($lelangs->status == 'tutup')
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Selamat kepada <strong>{{ $lelangs->pemenang }}</strong></h5>
    <p class="card-text"> Telah memenangkan lelang untuk barang <strong>{{ $lelangs->barang->nama_barang }}</strong> dengan harga <strong>Rp{{ number_format($lelangs->harga_akhir) }}</strong></p>
  </div>
</div>
@endif
</div>
<br>

<section class="content">
    <div class="container-fluid">     
        @if(!empty($lelangs))
      <div class="row">
        <div class="col-md-5">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
            <span class="badge {{ $lelangs->status == 'tutup' ? 'bg-danger' : 'bg-success' }}">{{ Str::title($lelangs->status) }}</span>
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
            <div class="card-header p-3 bg-primary">
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                
                <div class="tab-pane active" id="details">
                  <form class="form-horizontal">
                    <div class="form-group">
                      <label for="inputName">Nama Barang</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputName" value="{{ $lelangs->barang->nama_barang}}"readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail">Harga Awal</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputEmail" value="@currency($lelangs->barang->harga_awal)"readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail">Harga akhir</label>
                      <div class="col-sm-12">
                        <input type="text" class="form-control" id="inputEmail" value="@currency($lelangs->harga_akhir)"readonly>
                      </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputName2">Tanggal Lelang</label>
                           <div class="col-sm-12">
                            <input type="text" class="form-control" id="inputName2" value="{{ \Carbon\Carbon::parse($lelangs->tanggal_lelang)->format('j F Y')}}" readonly>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputEmail">Status</label>
                            <div class="col-sm-12">
                             <input type="text" class="form-control" id="inputEmail" value="{{ $lelangs->status}}"readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="inputExperience">Deskripsi Barang</label>
                      <div class="col-sm-12">
                        <textarea class="form-control" id="inputExperience" readonly>{{ $lelangs->barang->deskripsi_barang}}</textarea>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <div class="tab-pane" id="bid">
                    <form action="{{route('lelangin.store', $lelangs->id)}}" method="post" class="form-horizontal" data-parsley-validate>
                      @csrf
                    <div class="form-group">
                        <label for="inputName">Tawarkan Harga </label>
                      <div class="col-sm-12">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><strong>Rp.</strong></span>
                            </div>
                           
                          <input type="text" name="harga_penawaran"class="form-control @error('harga_penawaran') is-invalid @enderror" placeholder="Masukan Harga harus lebih dari @currency($lelangs->barang->harga_awal)">
                          @error('harga_penawaran')
                          <div class="invalid-feedback">
                            <b>{{ $message }}</b>
                          </div>
                          @enderror
                        </div>
                      </div>
                      </div>
                      @if($lelangs->status == 'dibuka')
                      <div class="form-group row">
                        <div class="">
                          <button type="button" data-toggle="modal" data-target="#modal-sl" class="btn btn-primary">Tawarkan</button>
                        </div>
                     </div>
                     @endif
                     <div class="modal fade" id="modal-sl">
                      <div class="modal-dialog modal-sl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Tawar Harga</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Apa kamu yakin untuk menawar {{ $lelangs->barang->nama_barang}} ?</p>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
    
                            <button type="submit" class="btn btn-primary">Iya</button>
                          
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    @if(auth()->user()->level == 'admin')
                      <a href="{{route('lelangadmin.index')}}" class="btn btn-primary">Back</a>
                    @elseif(auth()->user()->level == 'masyarakat')
                      <a href="{{route('dashboard.masyarakat')}}" class="btn btn-primary">Back</a>
                    @elseif(auth()->user()->level == 'petugas')
                      <a href="{{ route('lelangpetugas.index')}}" class="btn btn-primary">Back</a>
                    @endif
                    <!-- /.modal -->
                    </form>
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
        <div class="card-header bg-primary text-white">
          <strong>Data Pelelang {{ $lelangs->barang->nama_barang }}</strong>
      </div>
      <div class="card-body p-0">
      <table class="table table-bordered table-hover">
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
                        @if(auth()->user()->level == 'admin')
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
                <td>{{ $item->nama_barang }}</td>
                <td>@currency($item->harga)</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('j-F-Y') }}</td>
                <td>
                  <td><span class="badge text-white {{ $item->status == 'pending' ? 'bg-warning' : ($item->status == 'gugur' ? 'bg-danger' : 'bg-success') }}">{{ Str::title($item->status) }}</span></td>
                </td>
                @if (auth()->user()->level == 'admin')
                <td>
                  <a class="btn btn-primary btn-sm" href="{{ route('lelangadmin.show', $item->id)}}">
                    <i class="fas fa-folder">
                    </i>
                    View
                  </a>
                </td>
                @endif
                @if (auth()->user()->level == 'petugas')
                <td>
                <form action="{{ route('barang.destroy', [$item->id]) }}"method="POST">
                {{-- <a class="btn btn-primary"href="{{ route('barang.show', $item->id)}}">Detail</a>
                <a class="btn btn-warning"href="{{ route('barang.edit', $item->id)}}">Edit</a> --}}
    
                <a class="btn btn-primary btn-sm" href="{{ route('lelangpetugas.show', $item->id)}}">
                  <i class="fas fa-folder">
                  </i>
                  View
              </a>
              <a class="btn btn-info btn-sm" href="">
                  <i class="fas fa-pencil-alt">
                  </i>
                  Edit
              </a>
                @csrf
                @method('DELETE')   
                <button class="btn btn-danger btn-sm" type="submit"value="Delete">
                  <i class="fas fa-trash">
                  </i>
                  Delete
                </button>
              </form>
            </td>
            @else
            @endif
            </tr>
            @empty
            <tr>
              <td colspan="5" style="text-align: center" class="text-danger"><strong>Data masih kosong</strong></td>
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