@extends('templatesb.master')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Welcome Dashboard {{Auth::user()->name}}</h1>
</div>
</div>

<div class="row">
        @forelse ($lelangs as $item)
        
        <div class="col-md-3">
        <div class="card card-primary card-outline">
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
        @endforeach
</div>
@endsection