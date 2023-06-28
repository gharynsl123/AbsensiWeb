@extends('layouts.main-view')

@section('title')
Edit Your User
@endsection

@section('sidebar')
@endsection

@section('content')
<!-- content -->
<div class="container">
    <div class="rounded shadow-lg bg-white p-3">
        <div class="rounded px-2 bg-gray-200 d-flex mb-4 align-items-center">
            <p class="text-dark m-0 text-capitalize">edit your user</p>
            <div class="ml-auto">
                @if(!$kaprodi)
                <span class="badge badge-danger py-2 my-2 px-4">
                    Belum Ada Biodata
                </span>
                @else
                <span class="badge badge-success py-2 my-2 px-4">
                    Sudah Ada Biodata
                </span>
                @endif
            </div>
        </div>
        <form action="{{ route('update-kaprodi', $user->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 @if(!$kaprodi) d-none @else d-sm-inline-block @endif">
                    @foreach ($kaprodi as $item)
                    <div class="justify-content-center d-flex mb-4">
                        <div class="img-preview"
                            style="background-image: url('{{ asset('/storage/kaprodi/'.$item->photo) }}')"
                            id="preview-selected-image"></div>
                    </div>
                    @endforeach
                </div>
                <div class="@if(!$kaprodi) col-md-12 @else col-md-6 @endif">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input require type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input require type="email" class="form-control" id="email" name="email"
                            value="{{$user->email}}">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="inputGroupSelect01">level</label>
                            <select class="form-control" require id="inputGroupSelect01" name="level">
                                <option value="{{$user->level}}">{{$user->level}}</option>
                                <option value="guru">guru</option>
                                <option value="siswa">siswa</option>
                                <option value="kaprodi">kaprodi</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input require type="password" class="form-control" id="password" name="password">
                            @if ($errors->any())
                            <div class="alert p-2 mt-3 alert-danger">
                                @foreach ($errors->all() as $error)
                                <span>{{ $error }}</span>
                                @endforeach
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success col-md-2 text-uppercase">edit</button>
        </form>
    </div>

    <form action="{{ route('delete-kaprodi', $user->id) }}" class="mt-4" method="post">
        @csrf
        {{method_field('DELETE')}}
        <button type="submit" class="btn btn-danger px-5"
            onclick="return confirm('Apakah anda akan menghapus {{$user->name}} ?');">Hapus</button>
        <a href="{{url('/kaprodi')}}" class="btn btn-warning px-4">Cancel</a>
    </form>
</div>

<script>
const previewImage = (event) => {
    const imageFiles = event.target.files;
    const imageFilesLength = imageFiles.length;
    if (imageFilesLength > 0) {
        const imageSrc = URL.createObjectURL(imageFiles[0]);
        const imagePreviewElement = document.querySelector("#preview-selected-image");
        imagePreviewElement.style.backgroundImage = `url(${imageSrc})`;
        imagePreviewElement.style.display = "block";
    }
};
</script>
@endsection