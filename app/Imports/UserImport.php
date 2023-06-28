<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UserImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'      => $row['name'],
            'email'     => $row['email'], 
            'level'     => $row['level'], 
            'employe_since'     => new \DateTime(), 
            'password'  => Hash::make($row['password']),
        ]);
    }
}
