@extends('layouts.template')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif

    @if (Session::get('deleted'))
        <div class="alert alert-warning"> {{ Session::get('deleted') }} </div>
    @endif

    <h1><b>Data Klasifikasi Surat</b></h1>
    <br>
    <div class="card">
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <a href="{{ route('klasifikasi.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i>
                            Tambah</a>
                        <a href="" class="btn btn-info" style="color: white">Export Klasifikasi Surat</a>
                    </div>
                </div>
            </div>
            <br>
            <table id="" class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Klasifikasi Surat</th>
                        <th>Surat Tertaut</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @php
                    $no = 1;
                @endphp
                @foreach ($klasifikasi as $item)
                    <tbody>
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->letter_code }}</td>
                            <td>{{ $item->name_type }}</td>
                            <td>{{ $item->letter_count }}</td>
                            <td>
                                <a href="{{ route('klasifikasi.show', $item['id']) }}" class="btn btn-dark">Lihat</a>
                                <a href="{{ route('klasifikasi.edit', $item['id']) }}" class="btn btn-warning"><i
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
                                        <form action="{{ route('klasifikasi.delete', $item['id']) }}" method="POST">
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
    {{-- <div class="table-responsive col-lg-9">
        @if ($klasifikasi->count())
        {{$klasifikasi->links()}}
        @endif
    </div>  --}}
            @endsection
