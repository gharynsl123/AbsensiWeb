@extends('layouts.main-view')

@section('title')
Profile
@endsection

@section('sidebar')
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar content -->
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
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#usercollaps" aria-expanded="flase"
            aria-controls="usercollaps">
            <i class="fas fa-fw fa-server"></i>
            <span>Pengguna</span>
        </a>
        <div id="usercollaps" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{url('kaprodi')}}">Kaprodi</a>
                <a class="collapse-item" href="{{url('guru')}}">Guru</a>
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

    @if(Auth::user()->level != 'siswa')
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
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="/monthly-report">
            <i class="fas fa-fw fa-file"></i>
            <span>Laporan Bulanan</span></a>
    </li>
    @endif

    @if(Auth::user()->level == 'siswa')
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="/izin">
            <i class="fas fa-fw fa-info"></i>
            <span>Izin (udzur)</span></a>
    </li>
    @endif

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{url('profile')}}">
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
@if (Auth::user()->level == 'admin')
<div class="vh-90 d-flex align-items-center justify-content-center">
    <h4 class="text-center">You are Admin Here</h4>
</div>
@else
<div class="row">
    @foreach ($siswa as $item)
    <div class="col-md-auto d-flex mb-5 justify-content-center">
        <div class="img-preview" style="background-image: url('{{ asset('/storage/siswa/'.$item->photo) }}')"
            id="preview-selected-image"></div>
    </div>
    @endforeach

    <div class="col-md-9 mb-4">
        <div class="card shadow h-100 py-2">
            <div class="card-body">
                <div class="row">
                    <div class="mr-2">
                        <div class="text mb-3 text-success text-uppercase mb-1">Your Identity Card</div>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tr class="text-capitalize">
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>{{ $currentUserName }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ $currentUserEmail }}</td>
                                </tr>
                                @if ($siswa)
                                @foreach ($siswa as $siswa)
                                <tr class="text-capitalize">
                                    <td>barcode</td>
                                    <td>:</td>
                                    <td class="px-0">{!!DNS1D::getBarcodeSVG("$siswa->barcode", 'C128')!!}</td>

                                </tr>
                                <tr class="text-capitalize">
                                    <td>kelas</td>
                                    <td>:</td>
                                    <td>{{ $siswa->kelas->nama_kelas }}</td>
                                </tr>
                                <tr class="text-capitalize">
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>{{ $siswa->alamat }}</td>
                                </tr>
                                <tr class="text-capitalize">
                                    <td>No Hp</td>
                                    <td>:</td>
                                    <td>{{ $siswa->no_hp }}</td>
                                </tr>
                                <tr class="text-capitalize">
                                    <td>NISN</td>
                                    <td>:</td>
                                    <td>{{ $siswa->nisn }}</td>
                                </tr>
                                <tr class="text-capitalize">
                                    <td>NIS</td>
                                    <td>:</td>
                                    <td>{{ $siswa->nis }}</td>
                                </tr>
                                @endforeach
                                @else
                                belum ada data
                                @endif
                            </table>
                            @if($siswa)
                            <div class="d-flex mt-auto">
                                <a href="profile/edit/{{$item->id}}" class="btn btn-primary ml-2">Edit Bio</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection