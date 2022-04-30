<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminMessageModel;
use App\Models\AdminModel;

class Message extends BaseController {

    protected $message;
    protected $admin;

    public function __construct()
    {
        $this->message = new AdminMessageModel();
        $this->admin = new AdminModel();
    }

    public function index() {

        if (!session()->has('logged_admin')) {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Pesan Admin',
            'data_admin' => $this->admin->where('id', session()->get('id_admin'))->first(),
            'validation' => \Config\Services::validation(),
            'adminMessage' => $this->message->orderBy('nama_user', 'asc')->findAll()
        ];

        return view('admin/admin_message', $data);

    }

    public function kirim_balasan($id) {

        if(!$this->validate([
            'balasan' => [
                'rules' => 'max_length[200]',
                'errors' => [
                    'max_length' => 'Balasan Terlalu Panjang! (jangan lebih dari 200 karakter)'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $this->adminMessage->save([
            'id' => $id,
            'balasan' => $this->request->getVar('balasan')
        ]);

        return redirect()->to('/admin_message');

    }



}

?>