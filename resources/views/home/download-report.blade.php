<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download</title>
</head>
<body>
    <p>Berikut Adalah Laporan Dari make atas absensi selama sebulan setiap masing masing siswa</p>
@if ($absen->count() > 0)
    <div class="card border-left-primary shadow my-4 p-4">
            <div class="table-responsive">
                <table class="table table-hover table-bordered m-0" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Siswa</th>
                            <th>NISN</th>
                            <th>kelas</th>
                            <th>Kehadiran</th>
                            <th>Ketidakhadiran</th>
                        </tr>
                    </thead>
                    <tbody>
    
                        @foreach($absen as $absen)
                        <tr>
                            <td>{{ $absen->checkin }}</td>
                            <td>{{ $absen->siswa->user->name }}</td>
                            <td>{{$absen->siswa->nisn}}</td>
                            <td>{{ $absen->siswa->kelas->nama_kelas }}</td>
                            <td>{{ $absen->status }}</td>
                            <td>{{ $absen['ketidakhadiran'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    
    </div>
    @else
        <div class="alert alert-info" role="alert">
            No data available.
        </div>
    @endif
</body>
</html>