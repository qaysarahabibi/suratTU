@extends('layouts.template')

@section('content')
        <div class="container"> 
            <h1 class="display-4">Selamat Datang</h1>
            <p class="lead">Jangan lupa untuk mengecek informasi secara berkala ya!</p>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>Surat Keluar</h6>
                            <h5><i class="bx bx-news"></i> 1</h5>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6>Klasifikasi Surat</h6>
                            <h5><i class="bx bx-news" class=""></i>{{$klasifikasiTotal}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h6>Jumlah Staff</h6>
                            <h5><i class="bx bx-news"></i> {{$staffTotal}}</h5>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>Jumlah Guru</h6>
                            <h5><i class="bx bx-news" class=""></i> {{$guruTotal}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
@endsection
