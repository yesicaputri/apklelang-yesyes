@extends('templatesb.master')

@push('css')
<link href="{{ asset('admin2/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endpush

@section ('content')  
<div class="card">
    <div class="card-header bg-primary text-white ">
    <h6>Datang Barang Yang Akan Di Lelang</h6>
    </div>
    <div class="card-body">
        <a href="/barang/create" class="btn btn-primary">
          <i class="fas fa-plus"></i>
          Create
        </a>
      </div>
      <div class="card-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Tanggal</th>
            <th>Harga Awal</th>
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
            <form action="{{ route('barang.destroy', [$value->id]) }}" method="POST">
              <a class="btn btn-info mr btn-sm" href="{{ route('barang.show', $value->id) }}">
              <i class="fa fa-info-circle"></i>
              Detail</a>
              <a class="btn btn-warning mr btn-sm" href="{{ route('barang.edit', $value->id) }}">
              <i class="fas fa-edit"></i>Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mr btn-sm">
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

@push('scripts')
<script src="{{ asset('admin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin2/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin2/js/demo/datatables-demo.js') }}"></script>
<script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
@endpush