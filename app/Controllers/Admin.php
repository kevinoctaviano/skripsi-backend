<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\AbsensiModel;
use Myth\Auth\Password;

class Admin extends BaseController
{
    private $admin;
    private $absensi;
    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->absensi = new AbsensiModel();
    }
    public function index()
    {
        $data_user = $this->admin->getUsers(user_id());
        $hasil = $this->absensi->getDataAbsensi();
        // dd($hasil);
        $data = [
            'title'     => "Absensi Pegawai",
            'result'    => $data_user,
            'request'   => \Config\Services::request(),
            'hasil'     => $hasil
        ];
        return view('admin/dashboard', $data);
    }

    public function dataAdmin()
    {
        $adminlogin = $this->admin->getUsers(user_id());
        $data_user = $this->admin->getDataAdmin();
        // dd($data_user);
        $data = [
            'title'         => 'Data Admin',
            'result'        => $adminlogin,
            'hasil'         => $data_user,
            'validation'    => \Config\Services::validation(),
            'request'       => \Config\Services::request()
        ];
        return view('admin/data-admin', $data);
    }

    public function dataDivisi()
    {
        $adminlogin = $this->admin->getUsers(user_id());
        $data_divisi = $this->admin->getDataDivisi();
        // dd($data_divisi);
        $data = [
            'title'         => 'Data Divisi',
            'result'        => $adminlogin,
            'hasil'         => $data_divisi,
            'validation'    => \Config\Services::validation(),
            'request'       => \Config\Services::request()
        ];
        return view('admin/data-divisi', $data);
    }

    public function createDataDivisi()
    {
        // validasi
        if (!$this->validate([
            'divisi_name'    => 'required|is_unique[divisi.divisi_name]',
        ])) {
            return redirect()->back()->withInput();
        }

        $data = [
            'divisi_name'       => $this->request->getPost('divisi_name')
        ];

        $this->admin->insertDataDivisi($data);

        session()->setFlashdata('success', 'Berhasil menambahkan data divisi baru!');
        return redirect()->to('/data-divisi');
    }

    public function editDataDivisi($id)
    {
        $adminlogin = $this->admin->getUsers(user_id());
        $dataDivisiUpdate = $this->admin->editDataDivisi($id);
        $data = [
            'title'         => 'Edit Data Pegawai',
            'result'        => $adminlogin,
            'update'        => $dataDivisiUpdate,
            'request'   => \Config\Services::request()
        ];
        return view('admin/edit-data-divisi', $data);
    }

    public function updateDataDivisi($id)
    {
        $data = [
            'divisi_name' => $this->request->getPost('divisi_name')
        ];

        $this->admin->updateDataDivisi($id, $data);
        session()->setFlashdata('success', 'Berhasil mengubah data divisi!');
        return redirect()->to('/data-divisi');
    }

    public function hapusDataDivisi($id)
    {
        $this->admin->hapusDataDivisi($id);
        session()->setFlashdata('success', 'Berhasil menghapus data divisi!');
        return redirect()->to('/data-divisi');
    }

    public function createDataAdmin()
    {
        // validasi
        if (!$this->validate([
            'email'         => 'required|is_unique[users.email]',
            'username'      => 'required|is_unique[users.username]',
            'firstname'     => 'required',
            'lastname'      => 'required',
        ])) {
            return redirect()->back()->withInput();
        }

        $password = "passwordadminbuana";

        $data = [
            'email'         => $this->request->getPost('email'),
            'username'      => $this->request->getPost('username'),
            'firstname'     => $this->request->getPost('firstname'),
            'lastname'      => $this->request->getPost('lastname'),
            'password_hash' => Password::hash($password),
            'active'        => 1,
            'created_at'    => date("Y-m-d H:i:s"),
            'updated_at'    => date("Y-m-d H:i:s")
        ];

        if ($this->admin->insertDataAdmin($data)) {
            $last_id = $this->admin->insertID();
            $addPermission = ['group_id' => 2, 'user_id' => $last_id];

            $this->admin->insertPermission($addPermission);
        }

        session()->setFlashdata('success', 'Berhasil menambahkan data admin baru!');
        return redirect()->to('/data-admin');
    }

    public function hapusDataAdmin($id)
    {
        $this->admin->hapusDataAdmin($id);
        session()->setFlashdata('success', 'Berhasil menghapus data admin!');
        return redirect()->to('/data-admin');
    }

    public function editDataAdmin($id)
    {
        $adminlogin = $this->admin->getUsers(user_id());
        $dataAdminEdit = $this->admin->getUsers($id);
        $data = [
            'title'    => 'Edit Data Admin',
            'result'   => $adminlogin,
            'update'   => $dataAdminEdit,
            'request'  => \Config\Services::request()
        ];
        return view('admin/edit-data-admin', $data);
    }

    public function updateDataAdmin($id)
    {
        $data = [
            'email'     => $this->request->getPost('email'),
            'firstname' => $this->request->getPost('firstname'),
            'lastname'  => $this->request->getPost('lastname'),
            'username'  => $this->request->getPost('username'),
        ];

        $this->admin->updateDataAdmin($id, $data);
        session()->setFlashdata('success', 'Berhasil mengubah data admin baru!');
        return redirect()->to('/data-admin');
    }
}
