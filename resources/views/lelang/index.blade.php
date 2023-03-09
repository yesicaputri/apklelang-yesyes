@extends('templatesb.master')

@section('content')

<section class="section">
  <div class="card">
      <div class="card-header bg-primary d-flex justify-content-between">
        <a href="{{ route('lelang.create') }}" class="btn btn-info mb-3">{{ __('Tambah Lelang') }}</a>
      <a class="btn btn-info mb-3" href="{{route('cetak.lelang')}}">
      <li class="fas fa fa-print"></li>
      Cetak Data
      </a>
  </div>
      <div class="card-body">
          <table class="table table-bordered table-hover" id="table1">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Harga Awal</th>
                      <th>Harga Akhir</th>
                      <th>Pemenang</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                @forelse ($lelangs as $lelang)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ Str::of($lelang->barang->nama_barang)->title() }}</td>
                    <td>@currency($lelang->barang->harga_awal)</td>
                    <td>@currency($lelang->harga_akhir)</td>
                    <td>{{ $lelang->pemenang }}</td>
                    <td>
                      <span class="badge text-white {{ $lelang->status == 'tutup' ? 'bg-danger' : 'bg-success' }}">{{ Str::title($lelang->status) }}</span>
                    </td>
                    @if (auth()->user()->level == 'admin')
                    <td>
                        <a href="{{ route('lelang.show', $lelang->id) }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                          <i class="fa fa-info-circle"></i>
                        </a>
                    </td>
                    @endif
                    @if (auth()->user()->level == 'petugas')
                      <td>
                      <form action="{{ route('lelang.destroy', [$lelang->id]) }}"method="POST">
                      {{-- <a class="btn btn-primary"href="{{ route('barang.show', $lelang->id)}}">Detail</a>
                      <a class="btn btn-warning"href="{{ route('barang.edit', $lelang->id)}}">Edit</a> --}}

                      <a class="btn btn-primary btn-sm" href="{{ route('lelang.show', $lelang->id)}}">
                        <i class="fas fa-eye">
                        </i>
                        View
                    </a>
                    <a class="btn btn-info btn-sm" href="{{ route('barang.edit', $lelang->barangs_id)}}">
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
                    <td colspan="5" style="text-align: center" class="text-danger">Data lelang Kosong</td>
                  </tr>
                @endforelse

              </tbody>
          </table>
      </div>
  </div>

</section>
@endsection