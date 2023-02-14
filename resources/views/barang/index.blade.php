@extends('templatesb.master')

@section ('content')
<style>
  .card {
     background-image: url("{{asset('')}}");
     height: 100%;
    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  } 
</style>    
<div class="card">
    <div class="card-header">
    <h6>Datang Barang Yang Akan Di Lelang</h6>
    </div>
    <div class="card-body">
        <a href="/barang/create" class="btn btn-primary">
          <i class="fas fa-plus"></i>
          Create
        </a>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Tanggal</th>
            <th>Harga Awal</th>
            <th>Gambar</th>
            <th>Deskripsi Barang</th>
            <th>Action</th>
          </tr>
          </thead>
          @foreach ($barangs as $value)
          <tbody>
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $value->nama_barang }}</td>
            <td>{{ $value->tgl }}</td>
            <td>@currency( $value->harga_awal )</td>
            <td>
              @if($value->image)
                <img src="{{ asset('storage/' . $value->image)}}" alt="{{ $value->nama_barang }}" class="img-fluid mt-3" width="75">
              @endif
          </td>
            <td>{{ $value->deskripsi_barang }}</td>
            <td>
            <form action="{{ route('barang.destroy', [$value->id]) }}" method="POST">
              <a class="btn btn-info mr-3" href="{{ route('barang.show', $value->id) }}">
              <i class="fa fa-info-circle"></i>
              Detail</a>
              <a class="btn btn-warning mr-3" href="{{ route('barang.edit', $value->id) }}">
              <i class="fas fa-edit"></i>Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm-3">
                <a>Delete
                <i class="fa fa-trash"></i>
                </a>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
      <!-- /.card-body -->
    </div>
@endsection