@extends('layouts.template')

@section('content')

<a href="{{ route('surat.index')}}" class="btn btn-dark">Kembali</a>
<a href="{{ route('klasifikasi.download', $letterType->id) }}" class="btn btn-dark">Cetak</a>

<h1 class="h2">Detail Surat</h1>
    <div class="card justify-content-center" style="width: 1000px; margin-bottom:20px;">
        <div class="card-body">
            <!-- Header Section -->
            <div id="header">
                <!-- Left Column -->
                <div id="left-column">
                    <h2 style="margin-top: 15px;">SMK WIKRAMA BOGOR</h2>
                    <p>Bisnis dan Manajemen<br>Teknologi Informasi dan Komunikasi<br>Pariwisata</p>
                </div>
                <!-- Right Column -->
                <div id="right-column" style="margin-top: 15px; margin-right: 10px;">
                    <p>Jl. Raya Wangun Kel. Sindangsari Bogor</p>
                    <p>Telp/Faks:(0251)8242411</p>
                    <p>e-mail: prohumasi@smkwikrama.sch.id</p>
                    <p>website: www.smkwikrama.sch.id</p>
                </div>
            </div>

            <p style="border-bottom: 4px solid black; "></p>

            <!-- Content Section -->
            <div class="content">
                <p>Tanggal Keluar: {{ date('d F Y', strtotime($letters['created_at'])) }}</p>
                <p>No: {{ $letters->letterType->letter_code }}</p>
                <p>Klasifikasi Surat: {{ $letters->letterType->name_type }}</p>
                <p>{!! $letters['content'] !!}</p>

                <p>Notulis : {{ $letters->notulisUser ? $letters->notulisUser->name : 'Notulis Tidak Ditemukan' }}</p>
                <p>
                    Penerima Surat :
                    @if($letters->recipients)
                        @foreach(json_decode($letters->recipients) as $recipientId)
                            {{ \App\Models\User::find($recipientId)->name }},
                        @endforeach
                    @else
                        Penerima Surat Tidak Ditemukan
                    @endif
                </p>

                <div id="right-columns">
                    <p>Hormat Kami,</p>
                    <p>Kepala SMK Wikrama Bogor</p>
                    <p>(...................................)</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card justify-content-center" style="width: 1000px; margin-bottom:20px; margin-left: 470px;">
        <div class="card-body">
            <div class="mb-3">
                <label for="recipients" class="form-label">Peserta Rapat</label><br>
                @foreach($guru as $item)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $item->id }}" id="recipients{{ $item->id }}"
                            name="recipients[]" {{ in_array($item->id, json_decode($letters->recipients)) ? 'checked' : '' }}>
                        <label class="form-check-label" for="recipients{{ $item->id }}">
                            {{ $item->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <td>Notulis : {{ $letters->notulisUser ? $letters->notulisUser->name : 'Notulis Tidak Ditemukan' }}</td>
        </div>
    </div>
@endsection
