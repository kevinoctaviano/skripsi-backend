<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Restapimodel;

class Restapipegawai extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    private $restapi;
    public function __construct()
    {
        $this->restapi = new Restapimodel();
    }
    public function index()
    {
        $data = $this->restapi->orderBy('id', 'ASC')->findAll();
        $response = [
            'absensi' => $data
        ];
        return $this->respond($response, 200);
    }

    public function show($id = null)
    {
        $data = $this->restapi->where('karyawan', $id)->findAll();
        if ($data) {
            $response = [
                'absensi' => $data
            ];
            return $this->respond($response, 200);
        } else {
            return $this->failNotFound("Data Absen dengan id $id tidak ditemukan!");
        }
    }

    public function create()
    {
        $karyawan = $this->request->getVar('karyawan');
        $getWaktuAbsen = $this->restapi->checkAbsen($karyawan);
        $date = date_create($getWaktuAbsen['waktu']);
        $waktuAbsen = date_format($date, 'Y-m-d');
        $waktuSekarang = date('Y-m-d');

        if (($getWaktuAbsen['waktu'] === NULL) or ($getWaktuAbsen['waktu'] !== NULL && $waktuAbsen !== $waktuSekarang)) {
            $data = [
                'waktu'         => date('Y-m-d H:i:s'),
                'karyawan'      => $karyawan,
                'absen_masuk'   => date('Y-m-d H:i:s'),
            ];
            if (!$this->restapi->save($data)) {
                return $this->fail($this->restapi->errors());
            }
            $response = [
                'status'    => 201,
                'error'     => null,
                'messages'  => [
                    'success'   => 'Berhasil absen masuk!'
                ]
            ];
            return $this->respond($response);
        } elseif ($waktuAbsen === $waktuSekarang) {
            $response = "Anda sudah absen hari ini!";
            return $this->fail($response);
        }
    }

    public function update($id = null)
    {
        $getWaktuAbsen = $this->restapi->checkAbsenUpdate($id);
        $getWaktuKeluar = $this->restapi->checkAbsenKeluar($id);
        $date = date_create($getWaktuAbsen['waktu']);
        $waktuAbsen = date_format($date, 'Y-m-d');
        $waktuSekarang = date('Y-m-d');

        if (($getWaktuKeluar['absen_keluar'] === null) && ($waktuAbsen === $waktuSekarang)) {
            $data['absen_keluar'] = date('Y-m-d H:i:s');
            $data['id'] = $id;
            $isExist = $this->restapi->where('id', $id)->findAll();
            if (!$isExist) {
                return $this->failNotFound("Data Absen dengan id $id tidak ditemukan!");
            }
            if (!$this->restapi->updateAbsenKeluar($data, $id)) {
                return $this->fail($this->restapi->errors());
            } else {
                $response = [
                    'status'    => 200,
                    'error'     => null,
                    'messages'  => [
                        'success' => 'Berhasil absen keluar!'
                    ]
                ];
                return $this->respond($response);
            }
        } elseif ($waktuAbsen !== $waktuSekarang) {
            $response = "Anda sudah tidak bisa absen keluar!";
            return $this->fail($response);
        } elseif ($getWaktuKeluar['absen_keluar'] !== null) {
            $response = "Anda sudah absen keluar!";
            return $this->fail($response);
        }
    }
}
