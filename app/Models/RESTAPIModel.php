<?php

namespace App\Models;

use CodeIgniter\Model;

class Restapimodel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'absensi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'waktu', 'karyawan', 'absen_masuk', 'absen_keluar'];

    protected $validationRules = [
        'karyawan' => 'required'
    ];

    protected $validationMessages = [
        'karyawan' => [
            'required' => 'Masukkan ID karyawan!'
        ]
    ];

    public function checkAbsen($karyawan)
    {
        $builder = $this->db->table('absensi');
        $builder->where('karyawan', $karyawan);
        $builder->select('waktu');
        $query = $builder->get()->getLastRow('array');
        return $query;
    }

    public function checkAbsenUpdate($id)
    {
        $builder = $this->db->table('absensi');
        $builder->where('id', $id);
        $builder->select('waktu');
        $query = $builder->get()->getLastRow('array');
        return $query;
    }

    public function checkAbsenKeluar($id)
    {
        $builder = $this->db->table('absensi');
        $builder->where('id', $id);
        $builder->select('*');
        $query = $builder->get()->getLastRow('array');
        return $query;
    }

    public function updateAbsenKeluar($data, $id)
    {
        $builder = $this->db->table('absensi');
        $builder->where('id', $id);
        $query = $builder->update($data);
        return $query;
    }
}
