<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Client([
            'name'     => $row[0], //a
            'last_name'    => $row[1], //b
            'email'    => $row[2], //b
            'phone'    => $row[3],
            'age'    => $row[4],
        ]);
    }
}
