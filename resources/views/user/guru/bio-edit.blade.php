@extends('layouts.main-view')

@section('title')
Edit Your Bio User
@endsection
@section('content')
<!-- maka tampilkan form untuk mengisi biodata -->
<div class="contariner card p-4 ">
    <div class="col-md-auto d-flex mb-3 justify-content-center">
        <div>
            <img id="preview-selected-image" class="img-preview"
                style="background-image: url('{{ asset('/storage/guru/'.$guru->photo) }}')" alt="">
        </div>
    </div>
    <form action="{{route('update-bio-guru', $guru->id)}}" method="post" id="myForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mb-4">
                <label for="name" for="inputGroupSelect01">Mapel</label>
                <select class="form-control" require id="inputGroupSelect01" name="id_mapel" required>
                    <option value="{{$guru->mapel->id}}">{{$guru->mapel->nama_mapel}}</option>
                    @foreach ($mapel as $item)
                    <option value="{{$item->id}}">{{$item->nama_mapel}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-4">
                <label for="name" for="inputGroupSelect01">Photo</label>
                <div class="mb-3">
                    <input type="file" class="form-control p-0" id="image-input" name="photo">

                </div>
            </div>
            <div class="col-md-6 mb-4">
                <label for="name" for="inputGroupSelect01">Nomor</label>
                <div class="mb-3">
                    <input type="number" value="{{$guru->nomor}}" class="form-control" name="nomor" required>
                </div>
            </div>

        </div>
        <button type="submit" class="btn btn-primary shadow">Ubah Biodata</button>
        <a type="submit" href="/guru" class="btn btn-warning shadow">Back</a>
    </form>
</div>
@endsection