<?php 

namespace App\Controllers\Auth;

use App\Models\UserModel;
use App\Controllers\BaseController;

class LupaPassword extends BaseController {

    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function index($username)
    {

        if (session()->has('logged_admin')) {
            return redirect()->to('/admin');
        } elseif (session()->has('logged_user')) {
            return redirect()->to('/');
        } elseif (!session()->has('lupa_password')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Lupa Password | MyTask',
            'user' => $this->user->where('username', $username)->first(),
            'validation' => \Config\Services::validation()
        ];

        return view('auth/lupa_password', $data);
    }

    public function cek() {

        if(!$this->validate([
            'jawaban' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jawaban tidak boleh kosong'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $jawaban = md5($this->request->getVar('jawaban'));
        $asli = $this->request->getVar('jawaban_asli');
        if($jawaban == $asli) {
            session()->setFlashdata('jawaban_benar', 'benar');
            return redirect()->back()->withInput();
        } else {
            $this->validator->setError('jawaban', 'Jawaban Salah!');
            return redirect()->back()->withInput();
        }

    }

    public function ubah_password() {

        if(!$this->validate([
            'password' => [
                'rules' => 'min_length[8]',
                'errors' => [
                    'min_length' => 'Password Terlalu Pendek!'
                ]
            ]
        ])) {
            session()->setFlashdata('jawaban_benar', 'benar');
            return redirect()->back()->withInput();
        }

        $this->user->save([
            'id' => $this->request->getVar('id'),
            'password' => md5($this->request->getVar('password'))
        ]);

        session()->destroy();

        echo "<script>alert('Ganti Password Berhasil');window.location='/'</script>";

    }

}

?>