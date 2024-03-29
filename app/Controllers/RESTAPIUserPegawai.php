<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PegawaiModel;

class Restapiuserpegawai extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;

    private $pegawai;
    function __construct()
    {
        $this->pegawai = new PegawaiModel();
    }
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = $this->pegawai->getPegawaiByID($id);
        if ($data) {
            $response = [
                'pegawai' => $data
            ];
            return $this->respond($response, 200);
        } else {
            return $this->failNotFound("Data Pegawai dengan id $id tidak ditemukan!");
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $password_lama = $this->request->getVar('password_lama');
        $password = $this->request->getVar('password');
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $databaru = [
            'password'  => $password_hash,
            'isUpdate'  => 1
        ];

        $isExist = $this->pegawai->where('id', $id)->findAll();
        if (!$isExist) {
            return $this->failNotFound("Data Absen dengan id $id tidak ditemukan!");
        }

        if (!password_verify($password_lama, $isExist[0]['password'])) {
            $response = 'Password lama tidak sesuai!';
            return $this->fail($response);
        }

        if (!$this->pegawai->updateDataPegawai($id, $databaru)) {
            return $this->fail($this->pegawai->errors());
        } else {
            $response = [
                'status'    => 200,
                'error'     => null,
                'messages'  => [
                    'success' => 'Berhasil update password!'
                ]
            ];
            return $this->respond($response);
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
