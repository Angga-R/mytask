<?php 

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AdminMessageModel;
use App\Models\TaskModel;
use App\Models\CatatanModel;
use App\Models\UserModel;

class Catatan extends BaseController {

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
            'title' => 'Catatan',
            'user' => $user,
            'task' => $this->task->where('user', $user['username'])->findAll(),
            'task_berjalan' => $this->task->where(['user' => $user['username'], 'status' => 'on-going'])->findAll(),
            'task_selesai' => $this->task->where(['user' => $user['username'], 'status' => 'selesai'])->findAll(),
            'task_gagal' => $this->task->where(['user' => $user['username'], 'status' => 'gagal'])->findAll(),
            'all_message' =>  $this->message->where('pengirim', $user['username'])->findAll(),
            'message' => $this->message->where(['pengirim' => $user['username'], 'dibaca' => 'false'])->findAll(),
            'catatan' => $this->catatan->where('user', $user['username'])->orderBy('dibuat_pada', 'DESC')->findAll()
        ];

        return view('user/catatan', $data);

    }

    public function add() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $user = $this->user->where('id', session()->get('id_user'))->first();

        $this->catatan->save([
            'user' => $user['username'],
            'content' => $this->request->getVar('catatan'),
            'dibuat_pada' => date('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('pesan', 'Tambah Catatan Berhasil');
        return redirect()->to('/catatan');

    }

    public function hapus($id) {

        if (!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $this->catatan->delete($id);
        session()->setFlashdata('pesan', 'Catatan Berhasil Dihapus');
        return redirect()->to('/catatan');
    }

}

?>