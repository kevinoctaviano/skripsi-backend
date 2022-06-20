<?php

namespace App\Controllers;

use App\Models\AdminModel;
use Myth\Auth\Password;

define("_TITLE", "Edit Profile");

class Profile extends BaseController
{
    private $_admin_model;
    public function __construct()
    {
        // helper('auth');
        $this->_admin_model = new AdminModel();
    }
    public function index()
    {
        $data_user = $this->_admin_model->getUsers(user_id());
        // dd($data_user);
        $data = [
            'title' => _TITLE,
            'result' => $data_user,
            'request'   => \Config\Services::request()
        ];
        return view('admin/edit', $data);
    }

    public function updateProfile($id)
    {
        $imageProfile = $this->request->getFile('foto');
        // dd($imageProfile);
        if ($imageProfile->getError() === 4) {
            # tidak ada file yang diupload
            $namaImage = 'undraw_profile.svg';
        } else {
            $namaImage = $imageProfile->getRandomName();
            $imageProfile->move('img', $namaImage);
        }

        $this->_admin_model->save([
            'id'        => $id,
            'firstname' => $this->request->getVar('firstname'),
            'lastname'  => $this->request->getVar('lastname'),
            'username'  => $this->request->getVar('username'),
            'img'       => $namaImage
        ]);

        session()->setFlashdata('success', 'Berhasil mengubah profile admin');
        return redirect()->to('/profile');
    }

    public function updatePassword()
    {
        $data_user = $this->_admin_model->getUsers(user_id());
        $data = [
            'title'         => "Ubah Password",
            'result'        => $data_user,
            'validation'    => \Config\Services::validation(),
            'request'   => \Config\Services::request()
        ];
        return view('admin/ubah-password', $data);
    }

    public function updatePasswordForm($id)
    {
        // validasi
        if (!$this->validate([
            'old_password' => 'required',
            'new_password' => 'required|strong_password',
            'confirmation_password' => 'required|matches[new_password]'
        ])) {
            return redirect()->to('/ubah-password')->withInput();
        }

        $this->_admin_model->save([
            'id' => $id,
            'password_hash' => Password::hash($this->request->getVar('new_password')),
        ]);

        session()->setFlashdata('success', 'mengubah password!');
        return redirect()->to('/ubah-password');
    }
}
