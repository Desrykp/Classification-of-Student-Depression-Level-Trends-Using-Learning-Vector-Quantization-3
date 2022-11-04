<?php

namespace App\Imports;

use App\Models\DataAwal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class DataAwalImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    //model fungsi import untuk panggil data di controller
    public function model(array $row)
    {
        $data = new DataAwal([
            'nama'      => $row['nama'],
            'jk'        => $row['jk'],
            'semester'  => $row['semester'],
            'x1'        => $row['x1'],
            'x2'        => $row['x2'],
            'x3'        => $row['x3'],
            'x4'        => $row['x4'],
            'x5'        => $row['x5'],
            'x6'        => $row['x6'],
            'x7'        => $row['x7'],
            'x8'        => $row['x8'],
            'x9'        => $row['x9'],
            'total'     => $row['total'],
            'kelas'     => $row['kelas'],
        ]);
        return $data;
    }
}
