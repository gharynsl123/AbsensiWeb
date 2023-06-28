<?php

namespace App\Http\Controllers;
use App\Jurusan;
use App\Kelas;
use App\User;
use App\Mapel;
use Carbon\Carbon;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create() {
        $user = User::all();
        $jurusan = Jurusan::all();
        return view('user.create', compact('user','jurusan'));
    }

    public function store()
    {
        $date = Carbon::now();
        $formatedDate = $date->format('d F Y');

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'level' => 'required',
            'password' => 'required|min:6',
        ]);
        
        if (request()->input('password')) {
            $data['password'] = bcrypt(request()->input('password'));
        }

        // Mengatur nilai employe_since secara otomatis
        $data['employe_since'] = $formatedDate;

        User::create($data);
        return redirect('/create-user')->with('success', 'User add successfully.');
    }

    public function mapelStore(Request $request)
    {

        Mapel::create($request->all());
        return redirect('create-user')->with('success', 'Mapel created successfully.');
    }

    public function kelasStore(Request $request)
    {
        Kelas::create($request->all());
        return redirect('create-user')->with('success', 'Kelas created successfully.');
    }

    public function jurusanStore(Request $request)
    {
        Jurusan::create($request->all());
        return redirect('create-user')->with('success', 'Jurusan created successfully.');
    }
}