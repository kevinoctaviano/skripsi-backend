<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PegawaiModel;
use CodeIgniter\API\ResponseTrait;

class AuthPegawai extends ResourceController
{
    use ResponseTrait;
    public function index()
    {
        $validation = \Config\Services::validation();
        $aturan = [
            "email" => [
                "rules"     => "required|valid_email",
                "errors"    => [
                    "required" => "Masukkan email!",
                    "valid_email" => "Masukkan email yang valid!"
                ]
            ],
            "password" => [
                "rules"     => "required",
                "errors"    => [
                    "required" => "Masukkan password!"
                ]
            ]
        ];
        $validation->setRules($aturan);
        if (!$validation->withRequest($this->request)->run()) {
            return $this->fail($validation->getErrors());
        }

        $model = new PegawaiModel();
        $email = $this->request->getVar("email");
        $password = $this->request->getVar("password");

        $data = $model->getDataPegawai($email);

        if (!$data) {
            return $this->fail("Email tidak ditemukan!");
        }
        if (!password_verify($password, $data[0]['password'])) {
            return $this->fail("Password tidak sesuai!");
        }

        helper("jwt");
        $response = [
            "message" => "Autentikasi berhasil dilakukan",
            "data" => $data,
            "access_token" => createJWT($email, $data[0]['divisi_name'])
        ];
        return $this->respond($response);
    }
}
