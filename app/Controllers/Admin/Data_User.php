<?php 

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\TaskModel;
use App\Models\CatatanModel;

class Data_User extends BaseController {

    protected $user;
    protected $admin;
    protected $task;
    protected $catatan;

    public function __construct()
    {
        $this->user = new UserModel();
        $this->admin = new AdminModel();
        $this->task = new TaskModel();
        $this->catatan = new CatatanModel();
    }

    public function index() {

        if (!session()->has('logged_admin')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Data User | Admin',
            'data_admin' => $this->admin->where('id', session()->get('id_admin'))->first(),
            'datatable' => true,
            'user' => $this->user->findAll(),
            'task' => $this->task,
            'catatan' => $this->catatan
        ];

        return view('admin/data_user', $data);

    }

    public function hapus_user($id) {

        if (!session()->has('logged_admin')) {
            return redirect()->to('/');
        }

        $this->user->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/data_user');
    }

}

?>