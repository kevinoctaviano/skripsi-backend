<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\RESTAPIModel;

class RESTAPIPegawai extends ResourceController
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
        $this->restapi = new RESTAPIModel();
    }
    public function index()
    {
        $data = $this->restapi->orderBy('id', 'ASC')->findAll();
        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data = $this->restapi->where('id', $id)->findAll();
        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data Absen dengan id $id tidak ditemukan!");
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
        $data = [
            'waktu'         => date('Y-m-d H:i:s'),
            'karyawan'      => $this->request->getVar('karyawan'),
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
        $data = $this->request->getRawInput();
        $data['absen_keluar'] = date('Y-m-d H:i:s');
        $data['id'] = $id;

        $isExist = $this->restapi->where('id', $id)->findAll();
        if (!$isExist) {
            return $this->failNotFound("Data Absen dengan id $id tidak ditemukan!");
        }
        if (!$this->restapi->save($data)) {
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
