<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\RencanaPengembanganModel;

class RencanaPengembangan extends BaseController {

    protected $pengembangan;
    protected $admin;

    public function __construct()
    {
        $this->pengembangan = new RencanaPengembanganModel();
        $this->admin = new AdminModel();
    }

    public function index() {

        if (!session()->has('logged_admin')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Rencana Pengembangan',
            'data_admin' => $this->admin->where('id', session()->get('id_admin'))->first(),
            'validation' => \Config\Services::validation(),
            'rencana' => $this->pengembangan->where(['status' => 'belum selesai'])->orderBy('created_at', 'desc')->findAll(),
            'rencana_end' => $this->pengembangan->where(['status' => 'selesai'])->orWhere(['status' => 'gagal'])->orderBy('tgl_selesai', 'desc')->findAll()
        ];

        return view('admin/rencana_pengembangan', $data);

    }

    public function tambah_rencana() {

        if (!session()->has('logged_admin')) {
            return redirect()->to('/');
        }

        if(!$this->validate([
            'isi_rencana' => [
                'rules' => 'max_length[80]',
                'errors' => [
                    'max_length' => 'Rencana Terlalu Panjang! (jangan lebih dari 80 karakter)'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $this->pengembangan->save([
            'isi_rencana' => $this->request->getVar('isi_rencana'),
            'status' => 'belum selesai'
        ]);

        session()->setFlashdata('pesan', 'Menambah Rencana Pengembangan Berhasil');
        return redirect()->to('/pengembangan');

    }

    public function rencana_selesai($id) {
        
        $this->pengembangan->save([
            'id' => $id,
            'status' => 'selesai',
            'tgl_selesai' => date('Y-m-d')
        ]);

        return redirect()->to('/pengembangan');

    }

    public function rencana_gagal($id) {
        
        $this->pengembangan->save([
            'id' => $id,
            'status' => 'gagal',
            'tgl_selesai' => date('Y-m-d')
        ]);

        return redirect()->to('/pengembangan');

    }

}

?>