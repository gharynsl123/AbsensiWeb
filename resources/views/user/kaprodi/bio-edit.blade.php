@extends('layouts.main-view')

@section('title')
Edit Your Bio User
@endsection
@section('content')
<!-- maka tampilkan form untuk mengisi biodata -->
<div class="contariner card p-4 ">
    <div class="img-preview mb-5" style="background-image: url('{{ asset('/storage/kaprodi/'.$kaprodi->photo) }}')"
        id="preview-selected-image"></div>
    <form action="{{route('update-bio-kaprodi', $kaprodi->id)}}" method="post" id="myForm"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-4">
                <label for="name" for="inputGroupSelect01">Mapel</label>
                <select class="form-control" require id="inputGroupSelect01" name="id_jurusan" required>
                    <option value="{{$kaprodi->jurusan->id}}">{{$kaprodi->jurusan->nama_jurusan}}</option>
                    @foreach ($jurusan as $item)
                    <option value="{{$item->id}}">{{$item->nama_jurusan}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-4">
                <label for="name" for="inputGroupSelect01">Photo</label>
                <div class="mb-3">
                    <input type="file" class="form-control p-0" id="image-input" name="photo">

                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary shadow">Ubah Biodata</button>
        <a type="submit" href="/kaprodi" class="btn btn-warning shadow">Back</a>
    </form>
</div>
@endsection