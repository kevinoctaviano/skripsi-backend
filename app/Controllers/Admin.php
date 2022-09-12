<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\AbsensiModel;
use Myth\Auth\Password;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends BaseController
{
    private $admin;
    private $absensi;
    public function __construct()
    {
        $this->admin = new AdminModel();
        $this->absensi = new AbsensiModel();
        helper('form');
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

    public function getHour($date)
    {
        $tanggal = date_create($date);
        return date_format($tanggal, 'H:i:s');
    }

    public function getDate($date)
    {
        $tanggal = date_create($date);
        return date_format($tanggal, 'd-m-Y');
    }

    public function getKeterangan($masuk, $keluar)
    {
        $datetime1 = strtotime($keluar);
        $datetime2 = strtotime($masuk);
        $hour = $datetime1 - $datetime2;
        $res = $hour / 3600;
        if ($res > 8 && $keluar != NULL) {
            return "Lembur";
        } elseif ($res <= 8 && $keluar != NULL) {
            return "Tidak Lembur";
        } else {
            return "Belum Absen Keluar";
        }
    }

    public function exportExcel()
    {
        $btnExcel = $this->request->getPost('btnExcel');
        $laporan = $this->absensi->getDataAbsensi();

        // dd($laporan);

        if (isset($btnExcel)) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', 'DATA ABSENSI');
            $sheet->mergeCells('A1:E1');
            $sheet->getStyle('A1')->getFont()->setBold(true);

            $sheet->setCellValue('A3', 'No');
            $sheet->setCellValue('B3', 'Waktu');
            $sheet->setCellValue('C3', 'Nama Pegawai');
            $sheet->setCellValue('D3', 'Divisi');
            $sheet->setCellValue('E3', 'Absen Masuk');
            $sheet->setCellValue('F3', 'Absen Keluar');
            $sheet->setCellValue('G3', 'Keterangan');

            $no = 1;
            $numRows = 4;

            foreach ($laporan as $key) {

                $absen_masuk = $this->getHour($key['absen_masuk']);
                $absen_keluar = $this->getHour($key['absen_keluar']);
                $tanggal = $this->getDate($key['waktu']);

                $keterangan = $this->getKeterangan($key['absen_masuk'], $key['absen_keluar']);

                $namaLengkap = $key['firstname'] . ' ' . $key['lastname'];
                $sheet->setCellValue('A' . $numRows, $no);
                $sheet->setCellValue('B' . $numRows, $tanggal);
                $sheet->setCellValue('C' . $numRows, $namaLengkap);
                $sheet->setCellValue('D' . $numRows, $key['divisi_name']);
                $sheet->setCellValue('E' . $numRows, $absen_masuk);
                $sheet->setCellValue('F' . $numRows, $absen_keluar);
                $sheet->setCellValue('G' . $numRows, $keterangan);

                $no++;
                $numRows++;
            }
            $sheet->getDefaultRowDimension()->setRowHeight(-1);
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            $sheet->setTitle('Laporan Absensi');

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename = "Laporan Absensi.xlsx"');
            header('Cache-Control:max-age=0');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            die();
        }
    }
}
