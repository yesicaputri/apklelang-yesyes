@extends('templatesb.master')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Petugas</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="row">

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Data Barang</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalbarang }}
                    </div>
                    </div>
                    <div class="col-auto">
                        <a href="/barang">
                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data Lelang
                        </div>
                    <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totallelang }}</div>
                    </div>
                        <div class="col">
                            
                                <div class="progress-bar bg-info" role="progressbar"
                                    style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                                </div>
                            
                        </div>
                    </div>
                <div class="col-auto">
                <a href="/lelang">
                    <i class="fas fa-fw fa-table fa-2x text-gray-300"></i>
                </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        Data Penawaran</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalpenawaran }}
                    </div>
                    </div>
                    <div class="col-auto">
                        <a href="/data-penawaran">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection