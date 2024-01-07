@extends('layouts.template')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if (Session::get('deleted'))
        <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif

    <h1><b>Data Staff TU</b></h1>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <a href="{{ route('staff.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Tambah</a>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('staff.index') }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" id="search" class="form-control">
                                <button type="submit" class="btn btn-primary">Cari Data</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            <br>
            <table id="" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                @php
                    $no = 1;
                @endphp
                @foreach ($staffs as $item)
                    <tbody>
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->role }}</td>
                            <td style="text-align: center">
                                <a href="{{ route('staff.edit', $item['id']) }}" class="btn btn-warning"><i
                                        class="bx bx-edit-alt"></i></a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal-{{ $item['id'] }}"><i
                                        class="bx bx-trash"></i></button>
                            </td>
                        </tr>

                        <div class="modal fade" id="confirmDeleteModal-{{ $item['id'] }}" tabindex="-1"
                            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="confirmDeleteModalLabel">Konfirmasi hapus</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus data ini?
                                        <br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('staff.delete', $item['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                @endforeach
            </table>
            <div class="table-responsive col-lg-9 d-flex">
                @if ($staffs->count())
                {{$staffs->links()}}
                @endif
            </div>
        </div>
    </div>
@endsection
