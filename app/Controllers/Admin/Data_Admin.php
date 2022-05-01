<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Data_Admin extends BaseController {

    protected $dataAdmin;

    public function __construct()
    {
        $this->dataAdmin = new AdminModel();
    }

    public function index() {

        if(!session()->has('logged_admin')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Data Admin',
            'validation' => \Config\Services::validation(),
            'data_admin' => $this->dataAdmin->where('id', session()->get('id_admin'))->first()
        ];

        return view('admin/data_admin', $data);

    }

    public function ganti_foto() {
        
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
        if($foto->getError() == 4) {
            $namaFoto = 'admin.jpg';
        } else {
            $namaFoto = $foto->getRandomName();
            $image->withFile($foto)
                ->fit(250, 250, 'center')
                ->save('img/admin/' . $namaFoto);
        }

        $this->dataAdmin->save([
            'id' => 1,
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Ganti Foto Berhasil');
        return redirect()->to('/data_admin');

    }

    public function ganti_nama() {

        if(!$this->validate([
            'nama' => [
                'rules' => 'max_length[20]|alpha_space',
                'errors' => [
                    'max_length' => 'Nama Terlalu Panjang!',
                    'alpha_space' => 'Nama Tidak bisa mengandung angka atau karakter lain!'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $this->dataAdmin->save([
            'id' => session()->get('id_admin'),
            'nama' => $this->request->getVar('nama')
        ]);

        session()->setFlashdata('pesan', 'Ganti Nama Berhasil');
        return redirect()->to('/data_admin');

    }

    public function ganti_email() {

        $this->dataAdmin->save([
            'id' => session()->get('id_admin'),
            'email' => $this->request->getVar('email')
        ]);

        session()->setFlashdata('pesan', 'Ganti Email Berhasil');
        return redirect()->to('/data_admin');

    }

    public function ganti_link() {

        $this->dataAdmin->save([
            'id' => session()->get('id_admin'),
            'link_portfolio' => $this->request->getVar('link')
        ]);

        session()->setFlashdata('pesan', 'Ganti Link Portfolio Berhasil');
        return redirect()->to('/data_admin');

    }

    public function ganti_tentang() {

        $this->dataAdmin->save([
            'id' => session()->get('id_admin'),
            'tentang' => $this->request->getVar('tentang')
        ]);

        session()->setFlashdata('pesan', 'Ganti Informasi Berhasil');
        return redirect()->to('/data_admin');

    }

    public function ganti_password() {

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

        $this->dataAdmin->save([
            'id' => session()->get('id_admin'),
            'password' => md5($this->request->getVar('password'))
        ]);

        session()->setFlashdata('pesan', 'Ganti Password Berhasil');
        return redirect()->to('/data_admin');

    }

}

?>