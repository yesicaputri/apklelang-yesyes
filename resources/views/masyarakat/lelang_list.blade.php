@extends('templatesb.master')

@section('content')
<div class="container">
        <div class="card mt-5">
            <div class="card-header d-flex justify-content-between">
                <a href="{{ route('masyarakat.dashboard') }}" class="btn btn-secondary ml-auto btn-md">
                    <i class="bi bi-house-fill"></i>
                    {{ __(' Home') }}</a>
                <h4 class="card-title">{{ __('Daftar Lelang Yang Masih Dibuka ') }}</h4>
            </div>
            <div class="card-body">
            </div>
        </div>
        <div class="card mt-5">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" style="width: 100%" id="table1">
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
                        <tbody>
                            @forelse ($lelangs as $lelang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Str::of($lelang->barang->nama_barang)->title() }}</td>
                                    <td>@currency($lelang->barang->harga_awal)</td>
                                    <td>@currency($lelang->harga_akhir)</td>
                                    <td>{{ \Carbon\Carbon::parse($lelang->tanggal)->format('j-F-Y') }}</td>
                                    <td>
                                        <span class="badge {{ $lelang->status == 'tutup' ? 'bg-danger' : 'bg-success' }}">{{ Str::title($lelang->status) }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-nowrap flex-column flex-md-row space-between">
                                            <a href="{{ route('lelang.show', $lelang->id) }}" class="btn btn-info btn-sm"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Detail">
                                                <i class="bi bi-info-square"></i>
                                            </a>
                                            @if ($lelang->status == 'dibuka')
                                                <a href="{{ route('lelang.masyarakat.penawaran', $lelang->id) }}"
                                                    class="btn btn-primary btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Edit">
                                                    <i class="bi bi-box-arrow-up"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center" class="text-danger">Data lelang Kosong
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection