@extends('layouts.main-view')

@section('title')
Izin
@endsection

@section('sidebar')
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('home')}}">
        <img src="{{ asset('images/icon-web.png') }}" class="image-thumbnail" style="width:2rem; " alt="Gambar">
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
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="/monthly-report">
            <i class="fas fa-fw fa-file"></i>
            <span>Laporan Bulanan</span></a>
    </li>
    @endif


    @if(Auth::user()->level == 'siswa')
    <!-- Nav Item - Charts -->
    <li class="nav-item active">
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

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>

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
@endsection

@section('content')
<div class="col-md-8 m-auto my-5">
    <div class="card h-auto">
        <div class="card-header px-3">
            <h6 class="mb-0 p-3">Buat Perizinan</h6>
        </div>
        <div class="card-body">
            <form action="{{route('izin-send')}}" id="izin-form" method="post">
                {{-- {{method_field('POST')}} --}}
                @csrf
                <div class="form-group row">
                    <div class="col-md-2 mb-2">
                        <label class="form-label">Nama Siswa</label>
                    </div>
                    <div class="col-md-10 mb-2">
                        <input type="text" required class="form-control" name="id_user" value="{{Auth::user()->id}} "
                            hidden>
                        <input type="text" required class="form-control" value="{{Auth::user()->name}} " disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2 mb-2">
                        <label class="form-label">Kelas</label>
                    </div>
                    <select class="form-control col-md-10" require id="inputGroupSelect01" name="id_kelas">
                            <option value="0">Choose...</option>
                            @foreach ($kelas as $item)
                            <option value="{{$item->id}}">{{$item->nama_kelas}}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group row">
                    <div class="col-md-2 mb-2">
                        <label class="label-form">Keterangan</label>
                    </div>
                    <div class="col-md-10 mb-2">
                        <select type="text" required class="form-control" id="keterangan" name="keterangan">
                            <option value="">Pilih Opsi</option>
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                            <option id="lainnya" value="lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row" id="description-container" style="display: none;">
                    <div class="col-md-2 mb-2">
                        <label for="deskripsi">Deskripsi</label>
                    </div>
                    <div class="col-md-10 mb-2">
                        <input type="text" name="deskripsi" id="deskripsi-text" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <input class="form-control" required type="file" id="formFile" style="height: 100px;"
                            name="bukti_foto">
                        <div id="passwordHelpBlock" class="form-text">
                            Kirim bukti keterangan
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end form-group ">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Core plugin JavaScript-->
<script>
    // Event handler untuk perubahan pada dropdown jabatan 
    const keterangan = document.querySelector("#keterangan");
    
    keterangan.addEventListener("change", function() {
        // Mendapatkan opsi yang dipilih pada dropdown jabatan
        const selectedOption = this.value;
        
        // Mendapatkan elemen div dengan id "description-container"
        const descriptionContainer = document.querySelector("#description-container");
        
        // Jika opsi yang dipilih adalah "lainnya"
        if (selectedOption === "lainnya") {
            // Tampilkan elemen div dengan id "description-container"
            descriptionContainer.style.display = "flex";
            descriptionContainer.querySelector("#deskripsi-text").setAttribute("required", true);
        } else {
        // Sembunyikan elemen div dengan id "description-container"
        descriptionContainer.style.display = "none";
    }
});

document.getElementById("izin-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Menghentikan pengiriman form secara langsung
    
    // Menampilkan pop-up dengan pesan "Selamat"
    alert("Selamat!");
    
    // Submit form secara manual
    this.submit();
});
</script>
@endsection