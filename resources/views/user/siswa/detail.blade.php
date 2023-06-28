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
                <a href="{{url('siswa/edit', $user->id)}}"
                    class="badge badge-success py-2 my-2 px-4 button-none shadow">Edit User</a>
                @if(!$siswa)
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
            @if($siswa)
            <div class="row mb-5">
                @foreach ($siswa as $item)
                <div class="col-md-auto d-flex my-auto justify-content-center">
                    <div class="img-preview"
                        style="background-image: url('{{ asset('/storage/siswa/'.$item->photo) }}')"
                        id="preview-selected-image"></div>
                </div>
                @endforeach
                <div class="col-md-8 table-responsive">
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
                            <td class="badge badge-primary py-2 mt-2 px-4">{{$user->level}}</td>
                        </tr>

                        @foreach ($siswa as $item)
                        <tr>
                            <th class="text-dark text-uppercase">Kelas</th>
                            <td>:</td>
                            <td class="px-0">
                                {{$item->kelas->nama_kelas}}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-dark text-uppercase">Nomor HP</th>
                            <td>:</td>
                            <td class="px-0">
                                {{$item->no_hp}}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-dark text-uppercase">nisn</th>
                            <td>:</td>
                            <td class="px-0">
                                {{$item->nisn}}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-dark text-uppercase">nis</th>
                            <td>:</td>
                            <td class="px-0">
                                {{$item->nis}}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-dark text-uppercase">Alamat</th>
                            <td>:</td>
                            <td class="px-0">
                                {{$item->alamat}}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-dark text-uppercase">Barcode</th>
                            <td>:</td>
                            <td class="px-0">{!!DNS1D::getBarcodeSVG("$item->barcode", 'C128')!!}</td>

                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <form action="{{ route('delete-bio-siswa', $item->id) }}" class="mt-4" method="post">
                <a href="/siswa/bio/edit/{{$item->id}}" class="btn btn-success px-4"><i class="fa fa-pen-to-square"></i></a>
                @csrf
                {{method_field('DELETE')}}
                <button type="submit"
                    onclick="return confirm('Apakah anda akan menghapus biodata dari {{$user->name}} ?');"
                    class="btn px-5 btn-danger shadow">Hapus Biodata</button>
                <a href="/siswa" class="btn px-5 btn-primary shadow">Back</a>
            </form>
            @else
            <div class="col-md-8 table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <th class="text-dark text-uppercase">Nama</th>
                        <td>:</td>
                        <td class="px-0">{{$user->name}}</td>

                    </tr>
                    <tr>
                        <th class="text-dark text-uppercase">E-mail</th>`
                        <td>:</td>
                        <td class="px-0">{{$user->email}}</td>
                    </tr>
                    <tr>
                        <th class="text-dark text-uppercase">Level</th>
                        <td>:</td>
                        <td class="badge badge-primary py-2 mt-2 px-4">{{$user->level}}</td>
                    </tr>
                    @foreach ($siswa as $item)
                    <tr>
                        <th class="text-dark text-uppercase">Kelas</th>
                        <td>:</td>
                        <td class="px-0">
                            {{$item->kelas->nama_kelas}}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-dark text-uppercase">Nomor HP</th>
                        <td>:</td>
                        <td class="px-0">
                            {{$item->no_hp}}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-dark text-uppercase">nisn</th>
                        <td>:</td>
                        <td class="px-0">
                            {{$item->nisn}}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-dark text-uppercase">nis</th>
                        <td>:</td>
                        <td class="px-0">
                            {{$item->nis}}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-dark text-uppercase">Alamat</th>
                        <td>:</td>
                        <td class="px-0">
                            {{$item->alamat}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <!-- maka tampilkan form untuk mengisi biodata -->
            <form action="{{route('create-siswa', $user->id)}}" method="post" id="myForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="name" for="inputGroupSelect01">kelas</label>
                        <select class="form-control" require id="inputGroupSelect01" name="id_kelas" required>
                            <option value="0">Choose...</option>
                            @foreach ($kelas as $item)
                            <option value="{{$item->id}}">{{$item->nama_kelas}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="name" for="inputGroupSelect01">Photo</label>
                        <div class="mb-3">
                            <input type="file" class="form-control p-0" id="image-input" name="photo" required>
                            <input type="number" class="form-control" id="image-input" name="id_user"
                                value="{{$user->id}}" hidden>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="name" for="inputGroupSelect01">Nomor HP</label>
                        <div class="mb-3">
                            <input type="number" class="form-control" name="no_hp" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="name" for="inputGroupSelect01">Alamat</label>
                        <div class="mb-3">
                            <input type="text" required class="form-control" name="alamat">
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="name" for="inputGroupSelect01">NISN</label>
                        <div class="mb-3">
                            <input type="number"  required id="nisn" class="form-control" name="nisn">

                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="name" for="inputGroupSelect01">NIS</label>
                        <div class="mb-3">
                            <input type="number"  required id="nis" class="form-control" name="nis">

                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary shadow">Create Biodata</button>
                <a type="submit" href="/siswa" class="btn btn-warning shadow">Back</a>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection