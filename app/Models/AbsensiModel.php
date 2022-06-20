<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table            = 'absensi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['waktu', 'karyawan', 'absen_masuk', 'absen_keluar'];

    public function getDataAbsensi()
    {
        $builder = $this->db->table('absensi');
        $builder->select('*');
        $builder->join('pegawai', 'pegawai.id = absensi.karyawan');
        $builder->join('divisi', 'divisi.divisi_id = pegawai.division');
        $builder->orderBy('absensi.id', 'ASC');
        $query = $builder->get()->getResultArray();
        return $query;
    }
}
