<?php 

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AdminMessageModel;
use App\Models\TaskModel;
use App\Models\UserModel;

class Task extends BaseController {

    protected $user;
    protected $task;
    protected $message;

    public function __construct()
    {
        $this->user = new UserModel();
        $this->task = new TaskModel();
        $this->message = new AdminMessageModel();
    }

    public function index() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $user = $this->user->where('id', session()->get('id_user'))->first();

        $data = [
            'title' => 'Task | Semua Task',
            'user' => $user,
            'validation' => \Config\Services::validation(),
            'task' => $this->task->where('user', $user['username'])->findAll(),
            'task_berjalan' => $this->task->where(['user' => $user['username'], 'status' => 'on-going'])->orderBy('start', 'DESC')->findAll(),
            'task_end' => $this->task->where(['user' => $user['username'], 'status' => 'selesai'])->orWhere('status', 'gagal')->orderBy('end', 'DESC')->findAll(),
            'task_selesai' => $this->task->where(['user' => $user['username'], 'status' => 'selesai'])->findAll(),
            'task_gagal' => $this->task->where(['user' => $user['username'], 'status' => 'gagal'])->findAll(),
            'all_message' =>  $this->message->where('pengirim', $user['username'])->findAll(),
            'message' => $this->message->where(['pengirim' => $user['username'], 'dibaca' => 'false'])->findAll(),
            'datatable' => true
        ];

        return view('user/semua_task', $data);

    }

    public function buat_task() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $user = $this->user->where('id', session()->get('id_user'))->first();

        $data = [
            'title' => 'Task | Buat Task Baru',
            'user' => $user,
            'validation' => \Config\Services::validation(),
            'task' => $this->task->where('user', $user['username'])->findAll(),
            'task_berjalan' => $this->task->where(['user' => $user['username'], 'status' => 'on-going'])->findAll(),
            'task_end' => $this->task->where(['user' => $user['username'], 'status' => 'selesai'])->orWhere('status', 'gagal')->orderBy('end', 'DESC')->findAll(),
            'task_selesai' => $this->task->where(['user' => $user['username'], 'status' => 'selesai'])->findAll(),
            'task_gagal' => $this->task->where(['user' => $user['username'], 'status' => 'gagal'])->findAll(),
            'all_message' =>  $this->message->where('pengirim', $user['username'])->findAll(),
            'message' => $this->message->where(['pengirim' => $user['username'], 'dibaca' => 'false'])->findAll(),
        ];

        return view('user/buat_task', $data);

    }

    public function berjalan() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $user = $this->user->where('id', session()->get('id_user'))->first();

        $data = [
            'title' => 'Task | Task Anda',
            'user' => $user,
            'task' => $this->task->where('user', $user['username'])->findAll(),
            'task_berjalan' => $this->task->where(['user' => $user['username'], 'status' => 'on-going'])->findAll(),
            'task_end' => $this->task->where(['user' => $user['username'], 'status' => 'selesai'])->orWhere('status', 'gagal')->orderBy('end', 'DESC')->findAll(),
            'task_selesai' => $this->task->where(['user' => $user['username'], 'status' => 'selesai'])->findAll(),
            'task_gagal' => $this->task->where(['user' => $user['username'], 'status' => 'gagal'])->findAll(),
            'all_message' =>  $this->message->where('pengirim', $user['username'])->findAll(),
            'message' => $this->message->where(['pengirim' => $user['username'], 'dibaca' => 'false'])->findAll(),
        ];

        return view('user/task_saat_ini', $data);

    }

    public function riwayat() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }
        
        $user = $this->user->where('id', session()->get('id_user'))->first();

        $data = [
            'title' => 'Task | Riwayat Task',
            'user' => $user,
            'task' => $this->task->where('user', $user['username'])->findAll(),
            'task_berjalan' => $this->task->where(['user' => $user['username'], 'status' => 'on-going'])->findAll(),
            'task_selesai' => $this->task->where(['user' => $user['username'], 'status' => 'selesai'])->findAll(),
            'task_gagal' => $this->task->where(['user' => $user['username'], 'status' => 'gagal'])->findAll(),
            'all_message' =>  $this->message->where('pengirim', $user['username'])->findAll(),
            'message' => $this->message->where(['pengirim' => $user['username'], 'dibaca' => 'false'])->findAll(),
            'datatable' => true
        ];

        return view('user/riwayat_task', $data);

    }

    public function new() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        if(!$this->validate([
            'content' => [
                'rules' => 'max_length[150]',
                'errors' => [
                    'max_length' => 'tidak boleh lebih dari 150 karakter!'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $user = $this->user->where('id', session()->get('id_user'))->first();

        $this->task->save([
            'user' => $user['username'],
            'content' => $this->request->getVar('content'),
            'start' => date('Y-m-d H:i:s'),
            'status' => 'on-going'
        ]);

        session()->setFlashdata('pesan', 'Task berhasil dibuat');
        return redirect()->to('/task_saat_ini');

    }

    public function selesai($id) {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $this->task->save([
            'id' => $id,
            'end' => date('Y-m-d H:i:s'),
            'status' => 'selesai'
        ]);

        session()->setFlashdata('pesan', 'Task telah selesai!');
        return redirect()->to('/riwayat_task');

    }

    public function gagal($id) {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $this->task->save([
            'id' => $id,
            'end' => date('Y-m-d H:i:s'),
            'status' => 'gagal'
        ]);

        session()->setFlashdata('pesan', '<span class="text-danger">Task telah gagal</span>');
        return redirect()->to('/riwayat_task');

    }

    public function hapus($id) {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $this->task->delete($id);

        session()->setFlashdata('pesan', 'Task Berhasil Dihapus!');
        return redirect()->to('/riwayat_task');
    }

}

?>