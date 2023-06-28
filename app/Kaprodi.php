<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Kaprodi extends Model
{
    protected $table = 'kaprodi';
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
    public function jurusan()
    {
        return $this->belongsTo('App\Jurusan', 'id_jurusan');
    }
}
