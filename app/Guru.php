<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
    public function mapel()
    {
        return $this->belongsTo('App\Mapel', 'id_mapel');
    }
}
