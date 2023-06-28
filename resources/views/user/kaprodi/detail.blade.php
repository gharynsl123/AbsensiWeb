@extends('layouts.main-view')

@section('title')
Detail {{$user->name}}
@endsection

@section('content')
<!-- content -->
<div class="container">
    <div class="card border-left-primary rounded-3 shadow-lg bg-white p-3">
        <div class="rounded px-2 bg-gray-200 d-flex align-items-center">
            <p class="text-dark m-0">Detail User</p>
            <div class="ml-auto">
                <a href="{{url('kaprodi/edit', $user->id)}}"
                    class="badge badge-success py-2 my-2 px-4 button-none shadow">Edit User</a>
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
        <div class="card-body">
            @if($kaprodi)
            <div class="row mb-5 ">
                @foreach ($kaprodi as $item)
                <div class="col-md-auto d-flex justify-content-center">
                    <div class="img-preview"
                        style="background-image: url('{{ asset('/storage/kaprodi/'.$item->photo) }}')"
                        id="preview-selected-image"></div>
                </div>
                @endforeach
                <div class="table-responsive col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-dark text-uppercase">Nama</th>
                            <td>:</td>
                            <td class="px-0">{{$user->name}}</td>

                        </tr>
                        <tr>
                            <th class="text-dark text-uppercase">E-mail</th>
                            <td>:</td>
                            <td class="px-0">{{$user->email}}</td>
                        </tr>
                        <tr>
                            <th class="text-dark text-uppercase">Level</th>
                            <td>:</td>
                            <td class="badge badge-primary py-2 my-2 px-4">{{$user->level}}</td>
                        </tr>
                        @foreach ($kaprodi as $item)
                        <tr>
                            <th class="text-dark text-uppercase">Jurusan</th>
                            <td>:</td>
                            <td class="px-0">
                                {{$item->jurusan->nama_jurusan}}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <form action="{{ route('delete-bio-kaprodi', $item->id) }}" class="mt-4" method="post">
                <a href="/kaprodi/bio/edit/{{$item->id}}" class="btn btn-success shadow"><i class="fa fa-pen-to-square"></i></a>
                @csrf
                {{method_field('DELETE')}}
                <button type="submit"
                    onclick="return confirm('Apakah anda akan menghapus biodata dari {{$user->name}} ?');"
                    class="btn px-5 btn-warning shadow">Hapus Biodata</button>
                <a href="/kaprodi" class="btn px-5 btn-primary shadow">Back</a>
            </form>
            @else
            <div class="table-responsive mb-2">
                <table class="table table-borderless">
                    <tr>
                        <th class="text-dark text-uppercase">Nama</th>
                        <td>:</td>
                        <td class="px-0">{{$user->name}}</td>

                    </tr>
                    <tr>
                        <th class="text-dark text-uppercase">E-mail</th>
                        <td>:</td>
                        <td class="px-0">{{$user->email}}</td>
                    </tr>
                    <tr>
                        <th class="text-dark text-uppercase">Level</th>
                        <td>:</td>
                        <td class="badge badge-primary py-2 my-2 px-4">{{$user->level}}</td>
                    </tr>
                    @foreach ($kaprodi as $item)
                    <tr>
                        <th class="text-dark text-uppercase">Jurusan</th>
                        <td>:</td>
                        <td class="px-0">
                            {{$item->jurusan->nama_jurusan}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <!-- maka tampilkan form untuk mengisi biodata -->
            <form action="{{route('create-kaprodi', $user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6 mb-2">
                        <label for="name" for="inputGroupSelect01">Jurusan</label>
                        <select class="form-control" require id="inputGroupSelect01" name="id_jurusan">
                            <option value="0">Choose...</option>
                            @foreach ($jurusan as $item)
                            <option value="{{$item->id}}">{{$item->nama_jurusan}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="name" for="inputGroupSelect01">Photo</label>
                        <div class="mb-3">
                            <input type="file" class="form-control p-0" id="image-input" name="photo">
                            <input type="number" class="form-control p-0" id="image-input" name="id_user"
                                value="{{$user->id}}" hidden>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary shadow">Create Biodata</button>
                <a type="submit" href="/kaprodi" class="btn btn-warning shadow">Back</a>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection