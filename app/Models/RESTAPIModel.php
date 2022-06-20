<?php

namespace App\Models;

use CodeIgniter\Model;

class RESTAPIModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'absensi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['waktu', 'karyawan', 'absen_masuk', 'absen_keluar'];

    protected $validationRules = [
        'karyawan' => 'required'
    ];

    protected $validationMessages = [
        'karyawan' => [
            'required' => 'Masukkan ID karyawan!'
        ]
    ];
}
