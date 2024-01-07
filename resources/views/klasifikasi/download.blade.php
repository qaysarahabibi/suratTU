<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #header {

            display: flex;
            align-items: flex-start;
            flex-direction: column;
        }
        

        img {
            width: 80px;
        }

        #left-column {
            flex: 1;
        }

        #right-column {
            flex: 1;
        }


        #left-column p {
            margin: 0;
        }

        #right-column p {
            margin: 5px;
            text-align: right;

        }

        hr {
            border-bottom: 3px solid black;
            padding-bottom: 5px;

        }
    </style>
</head>

<body>
    <div id="header">
        <div id="left-column">
            <h2>SMK WIKRAMA BOGOR</h2>
            <p>Bisnis dan Manajemen<br>Teknologi Informasi dan Komunikasi<br>Pariwisata</p>
        </div>
        <div id="right-column" style="margin-top: -110px;">
            <p>Jl. Raya Wangun Kel. Sindangsari Bogor</p>
            <p>Telp/Faks:(0251)8242411</p>
            <p>e-mail: prohumasi@smkwikrama.sch.id</p>
            <p>website: www.smkwikrama.sch.id</p>
        </div>
    </div>
    <br>
    <hr>
    <br>
    <br>
    <div id="header">
        <div id="left-column">
            <p>No : 123456-4/0003/SMK Wikrama Bogor/XII/2024</p>
            <p>Hal : <strong>Rapat PKL</strong></p>
        </div>
        <div id="right-column" style="margin-top: -110px;">
            <p>10 Januari 2024</p>
            <br>
            <p>Kepada</p>
            <p>Yth. Bapak/Ibu Terlampir</p>
            <p>di</p>
            <p>Tempat</p>
            
        </div>
    </div>
    <BR></BR>
    <div class="content">
        
        <p>{!! $klasifikasi['content'] !!}</p>
        <br>
        <br>
       
        <br>
        <br>
        <p>Hormat Kami,</p>
        <p>Kepala SMK Wikrama Bogor Bogor</p>
        <br>
        <br>
        <br>
        <p>(..........................)</p>
    </div>



</body>

</html>