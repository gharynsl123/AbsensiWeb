<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Mapel;
use App\Profile;
use App\Siswa;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $siswa = Siswa::where('id_user', auth()->user()->id)->get();
        $user = User::where('id', auth()->user()->id)
            ->where('name', auth()->user()->name)
            ->get();
        $gambar = Siswa::where('id_user', auth()->user()->id)->get();
        $currentUserName = auth()->user()->name;
        $currentUserEmail = auth()->user()->email;
        return view('profile.profile', compact('siswa', 'currentUserName', 'currentUserEmail','gambar'));
    }

    public function edit($id){
        $siswa = Siswa::find($id);
        $kelas = Kelas::all();
        return view('profile.edit', compact('kelas', 'siswa'));
    }

    public function update(Request $request, $id){
        $siswa = Siswa::find($id);
        $siswa->update($request->all());
        return redirect('/profile')->with('success', 'Profile berhasil diupdate');
    }

}