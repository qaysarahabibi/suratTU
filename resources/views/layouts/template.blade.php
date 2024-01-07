<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <title>Pengelolaan Surat</title>
    <style>
        li {
            list-style: none;
            margin: 20px 0 20px 0;
        }

        a {
            text-decoration: none;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            margin-left: -300px;
            transition: 0.4s;
        }

        .active-main-content {
            margin-left: 250px;
        }

        .active-sidebar {
            margin-left: 0;
        }

        #main-content {
            transition: 0.4s;
        }

        /* tutorial table ngikut sidebar */
        .table-container {
            margin-left: 0;
            transition: margin-left 0.4s;
        }

        .active-sidebar .table-container {
            margin-left: 200px;
        }

        .active-table-container {
            margin-left: 200px;
        }
    </style>
</head>

<body>
    <div>
        <div class="sidebar p-4 bg-primary" id="sidebar">
            <h4 class="mb-5 text-white"><b>PENGELOLAAN SURAT</b></h4>
            <li>
                <a class="text-white" href="{{route('dashboard')}}">
                    <i class="bi bi-house mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a class="text-white" href="{{ route('staff.index')}}">
                    <i class="bx bx-user"></i>
                    Data Staff TU   
                </a>
            </li>
            <li>
                <a class="text-white" href="{{ route('guru.indexGuru')}} ">
                    <i class="bx bx-user"></i>
                    Data Guru
                </a>
            </li>
            <li>
                <a class="text-white" href="{{ route('klasifikasi.index')}} ">
                    <i class="bx bx-envelope"></i>
                    Data Klasifikasi Surat  
                </a>
            </li>
            <li>
                <a class="text-white" href="{{ route('surat.index') }} ">
                    <i class="bx bx-envelope"></i>
                    Data Surat
                </a>
            </li>

          
            
            {{-- @if (Auth::check()) --}}
            {{-- <li>
                <a class="text-white" href="{{route('logout')}}">
                    <i class="bi bi-house mr-2"></i>
                    Logout
                </a>
            </li> --}}
            {{-- @endif --}}
        </div>
    </div>
    <div class="p-4" id="main-content">
        <button class="btn btn-primary" id="button-toggle">
            <i class="bi bi-list"></i>
        </button>

        <script>
            // event will be executed when the toggle-button is clicked
            document.getElementById("button-toggle").addEventListener("click", () => {

                // when the button-toggle is clicked, it will add/remove the active-sidebar class
                document.getElementById("sidebar").classList.toggle("active-sidebar");

                // when the button-toggle is clicked, it will add/remove the active-main-content class
                document.getElementById("main-content").classList.toggle("active-main-content");

                /* tutorial table ngikut sidebar */
                document.querySelector(".table-container").classList.toggle("active-table-container");
            });
        </script>

        <div class="container mt-5">
            @yield('content')
        </div>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"></script>
            <script src="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"></script>
            <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
            <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
            <script>
                $('#example').DataTable();
            </script>
        @stack('script')
    </div>
</body>

</html>