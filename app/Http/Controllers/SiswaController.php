<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Siswa;
use App\Kelas;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth');
     }
     public function siswa()
     {
         $user = User::all();
         $siswa = Siswa::all();
         return view('user.siswa.index', compact('user', 'siswa'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kelas = Kelas::all();
        $data = $request->all();
        $number = random_int(10000000, 99999999);

        $dataSiswa = [
            'id_user' => $data['id_user'],
            'id_kelas' => $data['id_kelas'],
            'no_hp' => $data['no_hp'],
            'alamat' => $data['alamat'],
            'nis' => $data['nis'],
            'nisn' => $data['nisn'],
            'barcode' => $number,
        ];


        if($request->hasFile('photo')){
            $destination_path = 'public/siswa'; //path tempat penyimpanan (storage/public/images/profile)
            $image = $request -> file('photo'); //mengambil request column photo
            $image_name = $image->getClientOriginalName(); //memberikan nama gambar yang akan disimpan di foto
            $path = $request->file('photo')->storeAs($destination_path, $image_name); //mengirimkan foto ke folder store
            $dataSiswa['photo'] = $image_name; //mengirimkan ke database
        }

        // dd($dataSiswa);

        Siswa::create($dataSiswa);
        return back()->with('success', 'Data siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $siswa = Siswa::where('id_user',$id)->get()->all();
        $kelas = Kelas::all();
        return view('user.siswa.detail', compact('siswa', 'user', 'kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = Kelas::all();
        $user = User::find($id);
        $siswa = Siswa::where('id_user',$id)->get()->all();
        return view('user.siswa.edit', compact('user', 'siswa', 'kelas'));
    }
    

    public function editbio($id) {
        $kelas = Kelas::all();
        $user = User::find($id);
        $siswa = Siswa::find($id);
        return view('user.siswa.bio-edit', compact('user', 'siswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Memanggil data user, Memanggil data kaprodi, Memanggil data mapel
        $user = User::find($id);
        $siswa = Siswa::find($id);
        $kelas = Kelas::all();
    
        $data = $request->all();
    
        $dataUser = [
            'name' => $data['name'],
            'email' => $data['email'],
            'level' => $data['level'],
            'password' => $data['password']
        ];
        // kalo kosong gunakan password lama jika tidak kosong gunakan password baru dan hash password
        if ($data['password'] == null) {
            $dataUser['password'] = $user->password;
        } else {
            $dataUser['password'] = bcrypt($data['password']);
        }

        if ($request->hasFile('photo')) {
            $destination_path = 'public/siswa';
            $image = $request->file('photo');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('photo')->storeAs($destination_path, $image_name);
            $dataSiswa['photo'] = $image_name;
        } else {
            // $dataKaprodi['photo'] = $kaprodi->photo;
        }
        
        $user->update($dataUser);
        // $kaprodi->update($dataKaprodi);
    
    
        // Redirect
        return redirect()->route('siswa')->with('success', 'Data berhasil diupdate');
    }

    public function bioupdate(Request $req, $id){
        // Memanggil data user, Memanggil data kaprodi, Memanggil data mapel
        $user = User::find($id);
        $siswa = Siswa::find($id);
        $kelas = Kelas::all();
    
        $data = $req->all();
    
        if ($req->hasFile('photo')) {
            $destination_path = 'public/siswa';
            $image = $req->file('photo');
            $image_name = $image->getClientOriginalName();
            $path = $req->file('photo')->storeAs($destination_path, $image_name);
            $data['photo'] = $image_name;
        } else {
            // $dataKaprodi['photo'] = $kaprodi->photo;
        }
        
        // $user->update($dataUser);
        $siswa->update($data);
    
        // Redirect
        return redirect()->route('siswa')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bioclear($id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();
        return redirect()->back();
    }

    public function clear($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/siswa');
    }
}