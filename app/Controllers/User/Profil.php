<?php 

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AdminMessageModel;
use App\Models\TaskModel;
use App\Models\CatatanModel;
use App\Models\UserModel;

class Profil extends BaseController {

    protected $user;
    protected $task;
    protected $catatan;
    protected $message;

    public function __construct()
    {
        $this->user = new UserModel();
        $this->task = new TaskModel();
        $this->catatan = new CatatanModel();
        $this->message = new AdminMessageModel();
    }

    public function index() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $user = $this->user->where('id', session()->get('id_user'))->first();

        $data = [
            'title' => 'Profil',
            'validation' => \Config\Services::validation(),
            'user' => $user,
            'task' => $this->task->where('user', $user['username'])->findAll(),
            'task_berjalan' => $this->task->where(['user' => $user['username'], 'status' => 'on-going'])->findAll(),
            'task_selesai' => $this->task->where(['user' => $user['username'], 'status' => 'selesai'])->findAll(),
            'task_gagal' => $this->task->where(['user' => $user['username'], 'status' => 'gagal'])->findAll(),
            'all_message' =>  $this->message->where('pengirim', $user['username'])->findAll(),
            'message' => $this->message->where(['pengirim' => $user['username'], 'dibaca' => 'false'])->findAll()
        ];

        return view('user/profil', $data);

    }

    public function ganti_foto() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }
        
        if(!$this->validate([
            'foto' => [
                'rules' => 'max_size[foto,4072]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Yang anda pilih bukan gambar',
                    'mime_in' => 'Yang anda pilih bukan gambar'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $image = \Config\Services::image();
        $foto = $this->request->getFile('foto');
        $foto_lama = $this->request->getVar('foto_lama');
        $gender = $this->request->getVar('gender');
        if($foto->getError() == 4) {
            if($gender == 'Laki-laki') {
                $namaFoto = 'boy.png';
            }else{
                $namaFoto = 'girl.png';
            }
        } else {
            $namaFoto = $foto->getRandomName();
            $image->withFile($foto)
                ->fit(250, 250, 'center')
                ->save('img/user/' . $namaFoto);
            unlink('img/user/' . $foto_lama);
        }

        $this->user->save([
            'id' => session()->get('id_user'),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Ganti Foto Berhasil');
        return redirect()->to('/profil');

    }

    public function ganti_username() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        if(!$this->validate([
            'username' => [
                'rules' => 'alpha_dash|min_length[5]',
                'errors' => [
                    'alpha_dash' => 'tidak boleh mengandung spasi / selain karakter strip(-),slash(_)',
                    'min_length' => 'Username telalu pendek!'
                ]
            ]
        ])){
            return redirect()->back()->withInput();
        }

        // validasi username
        $username_lama = $this->request->getVar('username_lama');
        $username = '@' . strtolower($this->request->getVar('username'));
        $cek_username = $this->user->where(['username' => $username])->first();
        if($username != $username_lama) {
            if($cek_username != null) {
                $this->validator->setError('username', 'Username Sudah Digunakan!');
                return redirect()->back()->withInput();
            }
        }

        $this->user->save([
            'id' => session()->get('id_user'),
            'username' => $username,
        ]);

        $task = $this->task->where('user', $username_lama)->findAll();
        foreach($task as $t) :
            $this->task->save([
                'id' => $t['id'],
                'user' => $username
            ]);
        endforeach;

        $catatan = $this->catatan->where('user', $username_lama)->findAll();
        foreach($catatan as $c) :
            $this->catatan->save([
                'id' => $c['id'],
                'user' => $username
            ]);
        endforeach;

        $adminMessage = $this->message->where('pengirim', $username_lama)->findAll();
        foreach($adminMessage as $a) :
            $this->message->save([
                'id' => $a['id'],
                'pengirim' => $username
            ]);
        endforeach;

        session()->setFlashdata('pesan', 'Ganti Username Berhasil');
        return redirect()->to('/profil');

    }

    public function ganti_nama() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        if(!$this->validate([
            'name' => [
                'rules' => 'max_length[20]|alpha_space',
                'errors' => [
                    'max_length' => 'Nama Terlalu Panjang!',
                    'alpha_space' => 'Nama Tidak bisa mengandung angka atau karakter lain!'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $name = $this->request->getVar('name');

        $this->user->save([
            'id' => session()->get('id_user'),
            'name' => $name
        ]);

        $name_lama = $this->request->getVar('name_lama');

        $adminMessage = $this->message->where('nama_user', $name_lama)->findAll();
        foreach($adminMessage as $a) :
            $this->message->save([
                'id' => $a['id'],
                'nama_user' => $name
            ]);
        endforeach;

        session()->setFlashdata('pesan', 'Ganti Nama Berhasil');
        return redirect()->to('/profil');

    }

    public function ganti_gender() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $this->user->save([
            'id' => session()->get('id_user'),
            'gender' => $this->request->getVar('gender')
        ]);

        session()->setFlashdata('pesan', 'Ganti Gender Berhasil');
        return redirect()->to('/profil');

    }

    public function ganti_pertanyaan_keamanan() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $this->user->save([
            'id' => session()->get('id_user'),
            'pertanyaan_keamanan' => $this->request->getVar('pertanyaan_keamanan')
        ]);

        session()->setFlashdata('pesan', 'Ganti Pertanyaan Keamanan Berhasil');
        return redirect()->to('/profil');

    }

    public function ganti_jawaban_keamanan() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        if(!$this->validate([
            'jawaban_keamanan' => [
                'rules' => 'max_length[50]',
                'errors' => [
                    'max_length' => 'Jawaban terlalu panjang!'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $this->user->save([
            'id' => session()->get('id_user'),
            'jawaban_keamanan' => md5($this->request->getVar('jawaban_keamanan'))
        ]);

        session()->setFlashdata('pesan', 'Ganti Jawaban Keamanan Berhasil');
        return redirect()->to('/profil');

    }

    public function ganti_password() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        if(!$this->validate([
            'password' => [
                'rules' => 'min_length[8]',
                'errors' => [
                    'min_length' => 'Password Terlalu Pendek'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $this->user->save([
            'id' => session()->get('id_user'),
            'password' => md5($this->request->getVar('password'))
        ]);

        session()->setFlashdata('pesan', 'Ganti Password Berhasil');
        return redirect()->to('/profil');

    }

}

?>