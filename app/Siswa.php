<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $guarded = [];
    public function kelas()
    {
        return $this->belongsTo('App\Kelas', 'id_kelas');
    } 

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
  

