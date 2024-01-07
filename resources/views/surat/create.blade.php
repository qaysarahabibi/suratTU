@extends('layouts.template')

@section('content')
<h3>Tambah Data Surat</h3>
<form action="{{ route('surat.store') }}" method="POST" class="card p-5">
    @csrf

    @if(Session::get('success'))
        <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif
    @if($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="mb-3 row 9-2">
        <div class="col-sm-6">
            <label for="letter_perihal" class="col-form-label">Perihal</label>
            <input type="text" class="form-control" id="letter_perihal" name="letter_perihal">
        </div>
        <div class="col-sm-6">
            <label for="letter_type_id" class="col-form-label">Klasifikasi Surat</label>
                <select name="letter_type_id" id="letter_type_id" class="form-select">
                    <option selected hidden disabled>Pilih</option>
                @foreach ($klasifikasi as $item)
                    <option value="{{ $item->id }}">{{ $item->name_type }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Isi Lampiran</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></textarea>
          </div>
        <div class="mb-3">
            <table class="table table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Peserta (ceklist jika "ya")</th>
                    </tr>
                </thead>
                @foreach ($guru as $item)
                    <tbody>
                        <tr>
                            <th>{{ $item->name }}</th>
                            <th><div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{ $item->id }}" id="recipients{{$item->id}}" name="recipients[]">
                                <label class="form-check-label" for="recipients{{ $item->id }}"></label>
                              </div></th>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Lampiran</label>
            <input class="form-control" type="file" id="formFile" name="attachment">
          </div>
        <div class="col-sm-6">
            <label for="notulis" class="col-form-label">Notulis</label>
                <select name="notulis" id="notulis" class="form-select">
                    <option selected hidden disabled>Pilih</option>
                @foreach ($guru as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    <button type="submit" class="btn btn-primary mt-3">Tambah data</button>
</form>
@endsection