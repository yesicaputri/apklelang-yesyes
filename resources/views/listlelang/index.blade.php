@extends('templatesb.master')

@section('content')
<div class="card">
  <div class="card-header bg-primary text-white">
    <h6>Datang Barang Yang Akan Di Lelang</h6>
  </div>
      <div class="card-body">
          <table class="table table-bordered table-striped" id="table1">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Harga Awal</th>
                      <th>Harga Lelang</th>
                      <th>Tanggal Lelang</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
                @forelse ($lelangs as $lelang)
              <tbody>
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ Str::of($lelang->barang->nama_barang)->title() }}</td>
                    <td>@currency($lelang->barang->harga_awal)</td>
                    <td>@currency($lelang->harga_akhir)</td>
                    <td>{{ \Carbon\Carbon::parse($lelang->tanggal)->format('j-F-Y') }}</td>
                    <td>
                      <span class="badge text-white {{ $lelang->status == 'ditutup' ? 'bg-danger' : 'bg-success' }}">{{ Str::title($lelang->status) }}</span>
                    </td>
                    @if (auth()->user()->level == 'masyarakat')
                    <td>
                      <div class="d-flex flex-nowrap flex-column flex-md-row justify-center">
                        <!-- <form action="{{ route('lelang.destroy', $lelang->barangs_id) }}" method="POST"> -->
                        <a href="{{ route('barang.show', $lelang->barangs_id) }}" class="btn btn-info mr-3 btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                          <i class="fa fa-info-circle"></i>
                          Detail
                        </a>
                        <a href="{{ route('barang.show', $lelang->barangs_id) }}" class="btn btn-warning mr-3 btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                          <i class="fas fa-dollar-sign"></i>
                          Tawar
                        </a>
                        <!-- </form> -->
                      </div>
                    </td>
                    @elseif (auth()->user()->level == 'admin')
                    <td>
                        <a href="{{ route('barang.show', $lelang->barangs_id) }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                          <i class="fa fa-info-circle"></i>
                          Detail
                        </a>
                    </td>
                    @elseif (auth()->user()->level == 'petugas')
                    <td>
                        <a href="{{ route('barang.show', $lelang->barangs_id) }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                          <i class="fa fa-info-circle"></i>
                          Detail
                        </a>
                        <a href="{{ route('barang.edit', $lelang->barangs_id) }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                          <i class="fas fa-edit"></i>
                          Edit
                        </a>
                    </td>
                    @endif
                    </tr>
                @empty
                  <tr>
                    <td colspan="5" style="text-align: center" class="text-danger">Data lelang Kosong</td>
                  </tr>
                @endforelse
          </table>
      </div>
  </div>
@endsection