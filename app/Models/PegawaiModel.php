<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class PegawaiModel extends Model
{
    protected $table            = 'pegawai';
    protected $primaryKey       = 'id';
    protected $useTimestamps    = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'nip', 'password', 'email', 'firstname', 'lastname', 'address', 'division'];

    public function getDataPegawai($email = false)
    {
        if ($email === false) {
            $builder = $this->db->table('pegawai');
            $builder->select('*');
            $builder->join('divisi', 'divisi.divisi_id = pegawai.division');
            $query = $builder->get()->getResultArray();
            return $query;
        } else {
            $builder = $this->db->table('pegawai');
            $builder->select('*');
            $builder->where('email', $email);
            $builder->join('divisi', 'divisi.divisi_id = pegawai.division');
            $query = $builder->get()->getResultArray();
            return $query;
        }
    }

    public function getDivisi()
    {
        $builder = $this->db->table('divisi');
        $builder->select('*');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function insertData($data)
    {
        $builder = $this->db->table('pegawai');
        $query = $builder->insert($data);
        return $query;
    }

    public function editDataPegawai($id)
    {
        $builder = $this->db->table('pegawai');
        $builder->join('divisi', 'divisi.divisi_id = pegawai.division');
        $builder->where('id', $id);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function updateDataPegawai($id, $data)
    {
        $builder = $this->db->table('pegawai');
        $builder->where('id', $id);
        $query = $builder->update($data);
        return $query;
    }

    public function hapusDataPegawai($id)
    {
        $builder = $this->db->table('pegawai');
        $builder->where('id', $id);
        $query = $builder->delete();
        return $query;
    }

    public function getDivisiPegawai($email = null)
    {
        $builder = $this->db->table('pegawai');
        $builder->join('divisi', 'divisi.divisi_id = pegawai.division');
        $builder->where('email', $email);
        $builder->select('divisi_name');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getPegawaiByID($id = null)
    {
        $builder = $this->db->table('pegawai');
        $builder->join('divisi', 'divisi.divisi_id = pegawai.division');
        $builder->where('id', $id);
        $builder->select('*');
        $query = $builder->get()->getResultArray();
        return $query;
    }
}
