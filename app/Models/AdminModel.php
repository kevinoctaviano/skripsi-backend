<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'firstname', 'lastname', 'email', 'img', 'username', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash', 'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at', 'created_at', 'updated_at'];

    public function getUsers($id = false)
    {
        if ($id === false) {
            $builder = $this->db->table('users');
            $builder->select('*');
            $query = $builder->get()->getResultArray();
            return $query;
        } else {
            $builder = $this->db->table('users');
            $builder->select('*');
            $builder->where('id', $id);
            $query = $builder->get()->getResultArray();
            return $query;
        }
    }

    public function getDataAdmin()
    {
        $admin = 2;
        $builder = $this->db->table('users');
        $builder->select('*');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->where('auth_groups_users.group_id', $admin);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function getDataDivisi()
    {
        $builder = $this->db->table('divisi');
        $builder->select('*');
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function insertDataDivisi($data)
    {
        $builder = $this->db->table('divisi');
        $query = $builder->insert($data);
        return $query;
    }

    public function editDataDivisi($id)
    {
        $builder = $this->db->table('divisi');
        $builder->where('divisi_id', $id);
        $query = $builder->get()->getResultArray();
        return $query;
    }

    public function updateDataDivisi($id, $data)
    {
        $builder = $this->db->table('divisi');
        $builder->where('divisi_id', $id);
        $query = $builder->update($data);
        return $query;
    }

    public function hapusDataDivisi($id)
    {
        $builder = $this->db->table('divisi');
        $builder->where('divisi_id', $id);
        $query = $builder->delete();
        return $query;
    }

    public function insertDataAdmin($data)
    {
        $builder = $this->db->table('users');
        $query = $builder->insert($data);
        return $query;
    }

    public function insertPermission($data)
    {
        $builder = $this->db->table('auth_groups_users');
        $query = $builder->insert($data);
        return $query;
    }

    public function hapusDataAdmin($id)
    {
        $builder = $this->db->table('users');
        $builder->where('id', $id);
        $query = $builder->delete();
        return $query;
    }

    public function updateDataAdmin($id, $data)
    {
        $builder = $this->db->table('users');
        $builder->where('id', $id);
        $query = $builder->update($data);
        return $query;
    }
}
