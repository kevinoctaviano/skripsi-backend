<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
use App\Models\AdminModel;

class Pegawai extends BaseController
{
    private $admin;
    private $pegawai;
    function __construct()
    {
        helper('auth');
        $this->pegawai = new PegawaiModel();
        $this->admin = new AdminModel();
    }
    public function index()
    {
        $adminlogin = $this->admin->getUsers(user_id());
        $data_user = $this->pegawai->getDataPegawai();
        $divisi = $this->pegawai->getDivisi();
        // dd($adminlogin);
        $data = [
            'title'         => 'Data Pegawai',
            'result'        => $adminlogin,
            'hasil'         => $data_user,
            'divisi'        => $divisi,
            'validation'    => \Config\Services::validation(),
            'request'   => \Config\Services::request()
        ];
        return view('admin/data-pegawai', $data);
    }

    public function createDataPegawai()
    {
        // validasi
        if (!$this->validate([
            'nip'       => 'required|is_unique[pegawai.nip]',
            'email'     => 'required|valid_email|is_unique[pegawai.email]',
            'firstname' => 'required',
            'lastname'  => 'required',
            'address'   => 'required',
        ])) {
            // return redirect()->to('/data-pegawai')->withInput();
            return redirect()->back()->withInput();
        }

        $password = "passwordpegawaibuana";

        $data = [
            'nip'       => $this->request->getPost('nip'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($password, PASSWORD_BCRYPT),
            'firstname' => $this->request->getPost('firstname'),
            'lastname'  => $this->request->getPost('lastname'),
            'address'   => $this->request->getPost('address'),
            'division'  => $this->request->getPost('division')
        ];

        $this->pegawai->insertData($data);

        session()->setFlashdata('success', 'Berhasil menambahkan data pegawai baru!');
        return redirect()->to('/data-pegawai');
    }

    public function editDataPegawai($id)
    {
        $adminlogin = $this->admin->getUsers(user_id());
        $dataPegawaiUpdate = $this->pegawai->editDataPegawai($id);
        $divisi = $this->pegawai->getDivisi();
        $data = [
            'title'         => 'Edit Data Pegawai',
            'result'        => $adminlogin,
            'update'        => $dataPegawaiUpdate,
            'divisi'        => $divisi,
            'request'   => \Config\Services::request()
        ];
        return view('admin/edit-data-pegawai', $data);
    }

    public function updateDataPegawai($id)
    {
        $data = [
            'nip'       => $this->request->getPost('nip'),
            'email'     => $this->request->getPost('email'),
            'firstname' => $this->request->getPost('firstname'),
            'lastname'  => $this->request->getPost('lastname'),
            'address'   => $this->request->getPost('address'),
            'division'  => $this->request->getPost('division')
        ];

        $this->pegawai->updateDataPegawai($id, $data);
        session()->setFlashdata('success', 'Berhasil mengubah data pegawai baru!');
        return redirect()->to('/data-pegawai');
    }

    public function hapusDataPegawai($id)
    {
        $this->pegawai->hapusDataPegawai($id);
        session()->setFlashdata('success', 'Berhasil menghapus data pegawai!');
        return redirect()->to('/data-pegawai');
    }
}
