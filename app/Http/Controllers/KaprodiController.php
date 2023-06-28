<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Jurusan;
use App\Kaprodi;
use Illuminate\Support\Facades\Validator;

class KaprodiController extends Controller
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
    public function kaprodi()
    {
        $user = User::all();
        return view('user.kaprodi.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        return view('user.kaprodi.addbio', compact('kaprodi', 'jurusan', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Memanggil data user, Memanggil data kaprodi, Memanggil data mapel
        $jurusan = Jurusan::all();
        $data = $request->all();
        
        $dataKaprodi = [
            'id_user' => $data['id_user'],
            'id_jurusan' => $data['id_jurusan'],
        ];

        if($request->hasFile('photo')){
            $destination_path = 'public/kaprodi'; //path tempat penyimpanan (storage/public/images/profile)
            $image = $request -> file('photo'); //mengambil request column photo
            $image_name = $image->getClientOriginalName(); //memberikan nama gambar yang akan disimpan di foto
            $path = $request->file('photo')->storeAs($destination_path, $image_name); //mengirimkan foto ke folder store
            $dataKaprodi['photo'] = $image_name; //mengirimkan ke database
        }

        Kaprodi::create($dataKaprodi);
        
        // Redirect
        return redirect()->back()->with('success', 'Data berhasil diupdate');
        
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
        $kaprodi = Kaprodi::where('id_user',$id)->get()->all();
        $jurusan = Jurusan::all();
        return view('user.kaprodi.detail', compact('kaprodi', 'user', 'jurusan'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jurusan = Jurusan::all();
        $user = User::find($id);
        $kaprodi = Kaprodi::where('id_user',$id)->get()->all();
        return view('user.kaprodi.edit', compact('kaprodi', 'jurusan', 'user'));
    }

    public function bioedit($id)
    {
        $jurusan = Jurusan::all();
        $user = User::find($id);
        $kaprodi = Kaprodi::find($id);
        return view('user.kaprodi.bio-edit', compact('kaprodi', 'jurusan', 'user'));
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
        $kaprodi = Kaprodi::find($id);
        $jurusan = Jurusan::all();
    
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

        // $dataKaprodi = [
        //     'id_user' => Auth()->user()->id,
        //     'id_jurusan' => $data['id_jurusan'],
        // ];
    
        
        if ($request->hasFile('photo')) {
            $destination_path = 'public/kaprodi';
            $image = $request->file('photo');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('photo')->storeAs($destination_path, $image_name);
            $dataKaprodi['photo'] = $image_name;
        } else {
            // $dataKaprodi['photo'] = $kaprodi->photo;
        }
        
        $user->update($dataUser);
        // $kaprodi->update($dataKaprodi);
    
    
        // Redirect
        return redirect()->route('kaprodi')->with('success', 'Data berhasil diupdate');
    }  
    public function bioupdate(Request $request, $id)
    {

        $kaprodi = Kaprodi::find($id);
        $jurusan = Jurusan::all();
    
        $data = $request->all();
        
        if ($request->hasFile('photo')) {
            $destination_path = 'public/kaprodi';
            $image = $request->file('photo');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('photo')->storeAs($destination_path, $image_name);
            $data['photo'] = $image_name;
        } else {
            // $dataKaprodi['photo'] = $kaprodi->photo;
        }
        
        $kaprodi->update($data);
    
    
        // Redirect
        return redirect()->route('kaprodi')->with('success', 'Data berhasil diupdate');
    }       
        

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function bioclear($id)
    {
        $kaprodi = kaprodi::find($id);
        $kaprodi->delete();
        return redirect()->back();
    }
    public function clear($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/kaprodi');
    }
}