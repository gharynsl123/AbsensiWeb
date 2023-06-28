<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mapel;
use App\Guru;
use Maatwebsite\Excel\Facades\Excel; 

class GuruController extends Controller
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
    
     public function guru()
     {
         $user = User::all();
         $guru = Guru::all();
         $mapel = Mapel::all();
         return view('user.guru.index', compact('user', 'mapel', 'guru'));
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
        $mapel = Mapel::all();
        $data = $request->all();

        $dataGuru = [
            'id_user' =>  $data['id_user'],
            'id_mapel' =>  $data['id_mapel'],
            'nomor' =>  $data['nomor'],
        ];

        if($request->hasFile('photo')){
            $destination_path = 'public/guru'; //path tempat penyimpanan (storage/public/images/profile)
            $image = $request -> file('photo'); //mengambil request column photo
            $image_name = $image->getClientOriginalName(); //memberikan nama gambar yang akan disimpan di foto
            $path = $request->file('photo')->storeAs($destination_path, $image_name); //mengirimkan foto ke folder store
            $dataGuru['photo'] = $image_name; //mengirimkan ke database
        }

        Guru::create($dataGuru);
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function import(Request $request){
        //melakukan import file
        Excel::import(new UserImport, request()->file('file'));
        //jika berhasil kembali ke halaman sebelumnya
        return back();
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
        $guru = Guru::where('id_user',$id)->get()->all();
        $mapel = Mapel::all();
        return view('user.guru.detail', compact('user', 'mapel', 'guru'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mapel = Mapel::all();
        $user = User::find($id);
        $guru = Guru::where('id_user',$id)->get()->all();
        return view('user.guru.edit', compact('user', 'mapel', 'guru'));
    }

    public function editbio($id)
    {
        $mapel = Mapel::all();
        $user = User::find($id);
        $guru = Guru::find($id);
        return view('user.guru.bio-edit', compact('user', 'mapel', 'guru'));
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
        $guru = Guru::find($id);
        $mapel = Mapel::all();
        
        // Mengambil data dari form
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        
        // Cek apakah password kosong
        if ($request->password == null) {
            // Jika kosong, maka password tetap
            $user->password = $user->password;
        } else {
        // Jika tidak kosong, maka lakukan validation dan password akan di-hash
            $this->validate($request, [
                'password' => 'required|min:6'
            ]);
            $user->password = bcrypt($request->password);
        }

        // Cek apakah ada file foto yang diunggah
        if ($request->hasFile('photo')) {
            // Jika ada, maka foto akan diupload
            $photoWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($photoWithExt, PATHINFO_FILENAME);
            
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('/public/guru/', $filenameSimpan);
        } else {
            // Jika tidak ada, maka foto akan diisi dengan foto default
            // $kaprodi->photo = 'images/icon-web.png';
        }
        

        $user->save();

        // Redirect
        return redirect()->route('guru')->with('success', 'Data berhasil diupdate');
        
    }

    public function bioupdate(Request $request, $id)
    {
        $guru = Guru::find($id);
        $mapel = Mapel::all();

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $destination_path = 'public/guru';
            $image = $request->file('photo');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('photo')->storeAs($destination_path, $image_name);
            $data['photo'] = $image_name;
        } else {
            // $dataKaprodi['photo'] = $kaprodi->photo;
        }
        // $user->update($dataUser);
        $guru->update($data);

        // Redirect
        return redirect()->route('guru')->with('success', 'Data berhasil diupdate');
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bioclear($id)
    {
        $guru = Guru::find($id);
        $guru->delete();
        return redirect()->back();
    }
    
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/guru');
    }
}
