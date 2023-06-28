<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Website Absensi</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Custome Boostrap -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>
    .links>a {
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-transform: uppercase;
    }
    </style>
</head>

<body>
    <div class="container vh-100 d-flex flex-column align-item-center justify-content-center">

        <div class="row d-flex justify-content-center">
            <div class="col-md-6 card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-center text-primary">Welcome To Web Absensi SMK Muhammadiyah 2
                        kuningan</h6>
                </div>
                <div class="card-body">
                    Kami hadir untuk membantu Anda mencatat kehadiran dengan mudah dan menyenangkan.
                    Tidak perlu khawatir lagi tentang absen manual yang membosankan.
                    Cukup kunjungi web kami, masukkan informasi Anda, dan selesaikan absensi dalam hitungan detik.
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            @if (Route::has('login'))
            <div class="links">
                @auth
                <a href="{{ url('/home') }}" class="btn btn-primary p-0 btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                        <i class="fas fa-home"></i>
                    </span>
                    <span class="text">Home</span>
                </a>

                @else
                <a href="{{ route('login') }}" class="btn btn-primary p-0 btn-icon-split btn-lg">
                    <span class="icon text-white-50">
                        <i class="fas fa-lock"></i>
                    </span>
                    <span class="text mx-3">Login</span>
                </a>
                @endauth
            </div>
            @endif

        </div>

    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
</body>

</html>