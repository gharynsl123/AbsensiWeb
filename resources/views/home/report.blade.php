@extends('layouts.main-view')

@section('title')
Monthly Report
@endsection

@section('sidebar')
<!-- Sidebar - Brand -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('home')}}">
        <img src="{{ asset('images/icon-web.png') }}" class="image-thumbnail" style="width:2rem;" alt="Gambar">
        <div class="sidebar-brand-text my-2 mx-2">Muhammadiyah<sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{url('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @if (Auth::user()->level == 'admin')
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Admin
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usercollaps" aria-expanded="flase"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-server"></i>
            <span>Pengguna</span>
        </a>
        <div id="usercollaps" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{url('/kaprodi')}}">Kaprodi</a>
                <a class="collapse-item " href="{{url('guru')}}">Guru</a>
                <a class="collapse-item" href="{{url('siswa')}}">Siswa</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{url('create-user')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Buat User</span></a>
    </li>
    @endif

    @if(Auth::user()->level == 'guru' || Auth::user()->level == 'kaprodi')
    <li class="nav-item">
        <a class="nav-link" href="{{url('create-user')}}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Buat Akademik</span></a>
    </li>
    @endif

    @if (Auth::user()->level != 'siswa')
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#akademikitem" aria-expanded="false"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-list"></i>
            <span>Akademik</span>
        </a>
        <div id="akademikitem" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{url('jurusan')}}">jurusan</a>
                <a class="collapse-item" href="{{url('mapel')}}">Mapel</a>
                <a class="collapse-item" href="{{url('kelas')}}">kelas</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('monthly-report')}}">
            <i class="fas fa-fw fa-file"></i>
            <span>Laporan Bulanan</span></a>
    </li>
    @endif

    @if(Auth::user()->level == 'siswa')
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{url('izin')}}">
            <i class="fas fa-fw fa-info"></i>
            <span>Izin (udzur)</span></a>
    </li>
    @endif

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="/profile">
            <i class="fas fa-fw fa-user"></i>
            <span>Profile</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#logoutModal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out"></i>
            <span>logout</span></a>
    </li>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Monthly Report</h1>
</div>

<!-- Earnings (Annual) Card Example -->
<form action="{{ route('monthly-report') }}" method="GET">
    <div class="row">
        <!-- Tanggal Mulai -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-5">
                            <div class="text-xs font-weight-bold mb-3 text-success text-uppercase mb-1">
                                Start Date</div>
                            <input type="date" class="form-control" name="start-date" id="start-date">
                        </div>
                        <div class="col-auto  d-none d-sm-inline-block">
                            <i class="fas fa-clock fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tanggal Berakhir -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-5">
                            <div class="text-xs font-weight-bold mb-3 text-danger text-uppercase mb-1">
                                End Date</div>
                            <input type="date" class="form-control" name="end-date"  id="end-date">
                        </div>
                        <div class="col-auto d-none d-sm-inline-block">
                            <i class="fas fa-check fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
    <button id="resetBtn" class="btn btn-secondary">Reset</button>
</form>

@if ($absen->count() > 0)
    
<div class="card border-left-primary shadow my-4 p-4">
        <div class="table-responsive">
            <table class="table table-hover table-bordered m-0" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>kelas</th>
                        <th>Kehadiran</th>
                        <th>Ketidakhadiran</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($absen as $absen)
                    <tr>
                        <td>{{ $absen->checkin }}</td>
                        <td>{{ $absen->siswa->user->name }}</td>
                        <td>{{$absen->siswa->nisn}}</td>
                        <td>{{ $absen->siswa->kelas->nama_kelas }}</td>
                        <td>{{ $absen->status }}</td>
                        <td>{{ $absen['ketidakhadiran'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

</div>
@else
    <div class="alert alert-info" role="alert">
        No data available.
    </div>
@endif



<a href="/download-report" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-download fa-sm text-white-50 mx-2"></i>
    Download File
</a>

<script>
    document.getElementById('resetBtn').addEventListener('click', function() {
        var today = new Date();
        var startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
        var endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);

        //  mengubah input start date menjadi tanggal hari ini
        document.getElementById('start-date').valueAsDate = startOfMonth;
        // Mengubah input end date menjadi tanggal akhir bulan
        document.getElementById('end-date').valueAsDate = endOfMonth;

        document.getElementById('filterForm').submit(); // Mengirimkan form
    });
</script>

@endsection