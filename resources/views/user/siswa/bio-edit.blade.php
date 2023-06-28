@extends('layouts.main-view')

@section('title')
Edit Your Bio User
@endsection
@section('content')
<!-- maka tampilkan form untuk mengisi biodata -->
<div class="contariner card p-4 ">
    <div class="col-md-auto d-flex mb-3 justify-content-center">
        <div class="img-preview" style="background-image: url('{{ asset('/storage/siswa/'.$siswa->photo) }}')"
            id="preview-selected-image"></div>
    </div>
    <form action="{{route('update-bio-siswa', $siswa->id)}}" method="post" id="myForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-4">
                <label for="name" for="inputGroupSelect01">kelas</label>
                <select class="form-control" require id="inputGroupSelect01" name="id_kelas" required>
                    <option value="{{$siswa->kelas->id}}">{{$siswa->kelas->nama_kelas}}</option>
                    @foreach ($kelas as $item)
                    <option value="{{$item->id}}">{{$item->nama_kelas}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-4">
                <label for="name" for="inputGroupSelect01">Photo</label>
                <div class="mb-3">
                    <input type="file" class="form-control p-0" id="image-input" name="photo" >
                    
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <label for="name" for="inputGroupSelect01">Nomor HP</label>
                <div class="mb-3">
                    <input type="number" value="{{$siswa->no_hp}}" class="form-control" name="no_hp" required>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <label for="name" for="inputGroupSelect01">Alamat</label>
                <div class="mb-3">
                    <input type="text" required class="form-control" value="{{$siswa->alamat}}" name="alamat">
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <label for="name" for="inputGroupSelect01">NISN</label>
                <div class="mb-3">
                    <input type="number" required id="nisn" value="{{$siswa->nisn}}" class="form-control" name="nisn">

                </div>
            </div>
            <div class="col-md-6 mb-4">
                <label for="name" for="inputGroupSelect01">NIS</label>
                <div class="mb-3">
                    <input type="number" required id="nis" value="{{$siswa->nis}}" class="form-control" name="nis">

                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary shadow">Ubah Biodata</button>
        <a type="submit" href="/siswa" class="btn btn-warning shadow">Back</a>
    </form>
</div>
@endsection