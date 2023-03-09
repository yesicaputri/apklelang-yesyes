@extends('templatesb.master')
@section('content')
<div class="card">
@foreach($lelangs as $item)
@if($item->pemenang == Auth::user()->name)
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Selamat kepada <strong>{{ $item->pemenang }}</strong></h5>
    <p class="card-text"> Telah memenangkan lelang untuk barang <strong>{{ $item->barang->nama_barang }}</strong> dengan harga <strong>Rp{{ number_format($item->harga_akhir) }}</strong></p>
  </div>
</div>

@endif
@endforeach
</div>
<br>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1>Welcome Dashboard {{Auth::user()->name}}</h1>
</div>

<div class="row">
        @forelse ($lelangs as $item)
        
        <div class="col-md-3">
        <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <span class="badge {{ $item->status == 'tutup' ? 'bg-danger' : 'bg-success' }}">{{ Str::title($item->status) }}</span>
            <div class="card-body">
                <div class="text-center black">
                    @if($item->barang->image)
                    <img src="{{ asset ('storage/'. $item->barang->image)}}" alt="{{ $item->barang->nama_barang }}" class="img-fluid mt-0">
                    @endif
                </div>
                <h3 class="profile-username text-center">{{ $item->barang ->nama_barang }}</h3>

                <h5 class="text-muted text-center">@currency($item->barang->harga_awal)</h5>
                <a href="{{ route('lelangin.create', $item->id)}}" class="btn btn-primary btn-block shadow-sm">Tawar</a>
            </div>
        </div>
        </div>
        </div>
        @endforeach
</div>
@endsection