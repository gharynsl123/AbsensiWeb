<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Izin;
use App\Kelas;

class IzinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $kelas = Kelas::all();
        return view('izin', compact('kelas'));
    }

    public function store(Request $request){
        $data = Izin::create($request -> all());
        if($request->hasFile('bukti_foto')){
            $request->file('bukti_foto')->move('buktiizin/',$request->file('bukti_foto')->getClientOriginalName());
            $data->bukti_foto = $request->file('bukti_foto')->getClientOriginalName();
            $data->save();
        }
        return redirect('/home');
    }
}
