@extends('layouts.template')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><b>Detail Klasifikasi Surat</b></h1>
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h4">{{ $klasifikasi->letter_code }} | <span <h6 class="card-subtitle mb-2 text-body-secondary">{{
            $klasifikasi->name_type }}</span></h1>
</div>

<div class="card" style="width: 18rem;">
    <div class="card-body">
        <a href="{{ route('klasifikasi.download', $klasifikasi->id) }}" class="btn btn-primary me-3 mb-3"><i
                class="bi bi-download"></i></a>
        <h4>{{ date('d F Y', strtotime($klasifikasi->created_at)) }}</h4>
        <h5>Penerima Surat:</h5>
        <ul>
            @foreach ($klasifikasi->recipientsUsers as $recipient)
            {{ $recipient->name }}
            @endforeach
        </ul>
    </div>
</div>
@endsection