@extends('templatesb.master')

@section('content')
<div class="card">
  <div class="card-header bg-primary">
  </div>
  <div class="card-body">
    @if (auth()->user()->level == 'admin')
      <a class="btn btn-primary" href="/admin/operator/create">
        <li class="nav-icon fa fas fa-user-plus"></li>
        Registrasi Operator
      </a>
    @endif
  </div>
<div class="card-body">
      <table class="table table-bordered table-hover"  id="table1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Level</th>
                <th>Telepon</th>
                <th></th>
            </tr>
        </thead>
        @foreach ($users as $value)
        <tbody>
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->username }}</td>
            <td>{{ $value->level }}</td>
            <td>{{ $value->telp }}</td>
            <td>
              <form action="{{ route('user.destroy', [$value->id]) }}" method="POST">
              <a class="btn btn-primary btn-sm" href="{{ route('user.show', $value->id)}}">
                <i class="fa fa-info-circle"></i>
                View
              </a>
              <a class="btn btn-info btn-sm" href="{{ route('user.edit', $value->id)}}">
                <i class="fas fa-pencil-alt"></i>
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
        </tr>
        </tbody>
        @endforeach
    </table>
  </div>
@endsection