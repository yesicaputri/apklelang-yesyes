@extends('templatesb.master')

@section('content') 
<div class="card">
<div class="card-header bg-primary text-white">
    <h4>Daftar Orang Yang Menawar</h4>
</div>
<div class="card-body">
  <table class="table table-bordered table-hover">
        <thead>
            <tbody>
                <tr>
                    <th>No</th>
                    <th>Nama Penawar</th>
                    <th>Nama Barang</th>
                    <th>Harga Penawaran</th>
                    <th>Tanggal lelang</th>
                    <th>Status</th>
                    @if(auth()->user()->level == 'petugas')
                    @else
                    @endif
                    @if(auth()->user()->level == 'admin')
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
              <span class="badge {{ $item->status == 'pending' ? 'bg-warning' : 'bg-success' }}">{{ Str::title($item->status) }}</span>
            </td>
            @if (auth()->user()->level == 'admin')
            
            @endif
            @if (auth()->user()->level == 'petugas')
            <td>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-sm">
            <i class="fas fa-crown"></i>
                  </button>
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
          <td colspan="5" style="text-align: center" class="text-danger"><strong>Data penawaran kosong</strong></td>
        </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection