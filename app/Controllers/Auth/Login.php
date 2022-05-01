<?php

namespace App\Controllers\Auth;

use App\Models\LoginAdminModel;
use App\Models\LoginUserModel;
use App\Controllers\BaseController;
use CodeIgniter\Cookie\Cookie;

class Login extends BaseController
{

    protected $user;
    protected $admin;

    public function __construct()
    {  
        $this->user = new LoginUserModel();
        $this->admin = new LoginAdminModel();
    }
    
    public function index()
    {

        if(isset($_COOKIE['admin'])) {
            $sub_id = substr($_COOKIE['admin'], 2, 1);
            $id = $this->admin->where('id', $sub_id)->first();
            if($id) {
                session()->set([
                    'logged_admin' => true,
                    'id_admin' => $sub_id
                ]);
            }
        } elseif (isset($_COOKIE['user'])) {
            $sub_id = substr($_COOKIE['user'], 2, 1);
            $id = $this->user->where('id', $sub_id)->first();
            if($id) {
                session()->set([
                    'logged_user' => true,
                    'id_user' => $sub_id
                ]);
            }
        }

        if (session()->has('logged_admin')) {
            return redirect()->to('/admin');
        } elseif (session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Login | MyTask',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/login', $data);
    }

    public function proses()
    {

        if (session()->has('logged_admin')) {
            return redirect()->to('/admin');
        } elseif (session()->has('logged_user')) {
            return redirect()->to('/');
        }

        if(!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'username tidak boleh kosong'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $username = $this->request->getVar('username');
        $password = md5($this->request->getVar('password'));
        $remember_me = $this->request->getVar('remember_me');
        $login_admin = $this->admin->where(['username' => $username])->first();
        $login_user = $this->user->where(['username' => $username])->first();
        // helper('cookie');

        if ($login_admin) {
            if ($login_admin->password == $password) {
                    session()->set([
                        'logged_admin' => true,
                        'id_admin' => $login_admin->id
                    ]);
                    if($remember_me) {
                        setcookie('admin', 'a7' . $login_admin->id . md5('admin'), strtotime('+1 months'), '/');
                    }
                    return redirect()->to('/admin');
            } else {
                $this->validator->setError('password', 'Password Salah!');
                return redirect()->back()->withInput();
            }
        } elseif ($login_user) {
            if ($login_user->password == $password) {
                    session()->set([
                        'logged_user' => true,
                        'id_user' => $login_user->id
                    ]);
                    if($remember_me) {
                        setcookie('user', 'a7' . $login_user->id . md5('user'), strtotime('+1 months'), '/' );
                    }
                    return redirect()->to('/');
            } else {
                session()->setFlashdata('salah_password', $login_user->username);
                $this->validator->setError('password', 'Password Salah!');
                return redirect()->back()->withInput();
            }
        } else {
            $this->validator->setError('username', 'Username Tidak Ditemukan!');
            return redirect()->back()->withInput();
        }
    }

}