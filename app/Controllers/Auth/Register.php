<?php

namespace App\Controllers\Auth;
use App\Models\UserModel;
use App\Models\LoginUserModel;
use App\Controllers\BaseController;

class Register extends BaseController
{

    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
        $this->cekUser = new LoginUserModel();
    }

    public function index()
    {

        if (session()->has('logged_admin')) {
            return redirect()->to('/admin');
        } elseif (session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Register | MyTask',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/register', $data);
    }

    public function proses()
    {
        if (session()->has('logged_admin')) {
            return redirect()->to('/admin');
        } elseif (session()->has('logged_user')) {
            return redirect()->to('/');
        }

        
        
        // validasi input
        if(!$this->validate([
            'username' => [
                'rules' => 'alpha_dash|min_length[5]',
                'errors' => [
                    'alpha_dash' => 'tidak boleh mengandung spasi / selain karakter strip(-),slash(_)',
                    'min_length' => 'Username telalu pendek!'
                ]
            ],
            'name' => [
                'rules' => 'alpha_space|min_length[4]',
                'errors' => [
                    'alpha_space' => 'tidak boleh ada karakter lain selain huruf dan spasi!',
                    'min_length' => 'Nama terlalu pendek!!',
                ]
            ],
            'gender' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih sesuai jenis kelamin anda!'
                ]
            ],
            'password' => [
                'rules' => 'min_length[8]',
                'errors' => [
                    'min_length' => 'Password minimal 8 karakter'
                ]
            ],
            'repeat_password' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi Password harus sama dengan Password'
                ]
            ],
            'jawaban_keamanan' => [
                'rules' => 'max_length[50]',
                'errors' => [
                    'max_length' => 'Jawaban terlalu panjang!'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }
                        
        // validasi username
        $username = '@' . strtolower($this->request->getVar('username'));
        $password = md5($this->request->getVar('password'));
        $cek_username = $this->cekUser->where(['username' => $username])->first();
        if($cek_username) {
            $this->validator->setError('username', 'Username Sudah Digunakan!');
            return redirect()->back()->withInput();
        }

        $this->user->save([
            'username' => $username,
            'name' => $this->request->getVar('name'),
            'gender' => $this->request->getVar('gender'),
            'password' => $password,
            'pertanyaan_keamanan' => $this->request->getVar('pertanyaan_keamanan'),
            'jawaban_keamanan' => md5($this->request->getVar('jawaban_keamanan'))
        ]);

        echo "<script>alert('Daftar Berhasil');window.location='/login'</script>";
    }
}