@extends('templatesb.master')

@section('content')
<div class="card">
        <div class="card-header bg-primary text-white">
        <h3>Data Penawaran {{Auth::user()->name}}</h3>
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
@endsection