<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $profile = 'profile';
    protected $guraded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user' );
    }
    public function siswa()
    {
        return $this->belongsTo('App\Siswa', 'id_siswa');
    }
}
