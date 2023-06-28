<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Siswa;
use App\User;
use App\Absen;
use App\Jurusan;
use App\Mapel;
use App\Kelas;
use Dompdf\Dompdf;
use Dompdf\Options;
use Carbon\CarbonTimeZone;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $currentUserName=auth()->user()->name;
        $absen=Absen::all();
        $siswa=Siswa::all();
        $date=Carbon::now(new CarbonTimeZone('Asia/Jakarta'));
        $hari=$date->format('d M Y');
        $waktu=$date->format('H:i A');
        return view('home.index', compact('hari', 'absen', 'waktu', 'currentUserName', 'siswa', 'date'));
    }

    public function jurusan() {
        $jurusan=Jurusan::all();
        return view('academic.jurusan', compact('jurusan'));
    }

    public function mapel() {
        $mapel=Mapel::all();
        return view('academic.mapel', compact('mapel'));
    }
    public function kelas() {
        $kelas=Kelas::all();
        return view('academic.kelas', compact('kelas'));
    }

    public function store(Request $request) {
        $input=$request->all();
        $date=Carbon::now(new CarbonTimeZone('Asia/Jakarta'));
        $nowdays = $date->today();
        

        // $input['barcode'] = $request->barcode;
        $siswa=Siswa::where('barcode', $request->barcode)->get();

        foreach($siswa as $u) {
            $id_siswa=$u->id;
        }

        if($siswa) {
            $absen=Absen::where('id_siswa', $id_siswa)->whereDate('checkin', $date->format('Y-m-d'))->first();

            if ($absen) {
                return redirect('/home')->with('error', 'Siswa ini sudah absen');
            }

            else {
                Absen::create([ 'id_siswa'=> $id_siswa,
                        'checkin'=> $date,
                        ]);
                return redirect('/home')->with('success', 'Absen Berhasil');
            }
        }

        else {
            return redirect('/home')->with('error', 'Siswa Tidak Ditemukan');
        }

        return redirect('/home')->with('success', 'Absen Berhasil');


    }

    public function show(Request $request) {
        // $date = Carbon::now();
        // $bulan = $date->format('F');
        // return view('home.report', compact('bulan'));

        // Ambil data laporan bulanan
        // Ambil data laporan bulanan
        // $absen = Absen::all();
        $startDate = $request->input('start-date');
        $endDate = $request->input('end-date');
    
        $absen = Absen::with('siswa.user')->whereBetween('checkin', [$startDate, $endDate])->get();
        $report = Absen::select(DB::raw('DATE(checkin) as date'), DB::raw('COUNT(*) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($group) {
                $kehadiran = $group->sum('status');
                $ketidakhadiran = $group->count() - $kehadiran;
    
                return [
                    'kehadiran' => $kehadiran,
                    'ketidakhadiran' => $ketidakhadiran,
                    'absen' => $group,
                ];
            });
    
        $siswa = Siswa::with('user')->get();

        return view('home.report', compact('report', 'siswa', 'absen'));
    }

    public function PDFGenerate(){
         // Menginisialisasi Dompdf dengan opsi default
         $options = new Options();
         $options->setIsHtml5ParserEnabled(true);
         $dompdf = new Dompdf($options);

         $absen = Absen::with('siswa.user')->get();
         $siswa = Siswa::with('user')->get();
     
         // Generate HTML dari view 'home.report'
         $html = view('home.download-report', compact('absen'))->render();
     
         // Mengubah HTML menjadi PDF
         $dompdf->loadHtml($html);
         $dompdf->setPaper('A4', 'portrait');
         $dompdf->render();
     
         // Mengunduh file PDF
         $dompdf->stream('monthly-report.pdf', ['Attachment' => false]);
    }


}
