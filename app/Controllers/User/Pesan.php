<?php 

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AdminMessageModel;
use App\Models\TaskModel;
use App\Models\UserModel;

class Pesan extends BaseController {

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
            'title' => 'Pesan | Semua Pesan',
            'user' => $user,
            'validation' => \Config\Services::validation(),
            'task' => $this->task->where('user', $user['username'])->findAll(),
            'task_berjalan' => $this->task->where(['user' => $user['username'], 'status' => 'on-going'])->orderBy('start', 'DESC')->findAll(),
            'task_end' => $this->task->where(['user' => $user['username'], 'status' => 'selesai'])->orWhere('status', 'gagal')->orderBy('end', 'DESC')->findAll(),
            'task_selesai' => $this->task->where(['user' => $user['username'], 'status' => 'selesai'])->findAll(),
            'task_gagal' => $this->task->where(['user' => $user['username'], 'status' => 'gagal'])->findAll(),
            'all_message' =>  $this->message->where('pengirim', $user['username'])->orderBy('created_at', 'DESC')->findAll(),
            'message' => $this->message->where(['pengirim' => $user['username'], 'dibaca' => 'false'])->findAll(),
        ];

        return view('user/pesan/semua_pesan', $data);

    }

    public function kirim_pesan() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $user = $this->user->where('id', session()->get('id_user'))->first();

        $data = [
            'title' => 'Pesan | Buat Pesan',
            'user' => $user,
            'validation' => \Config\Services::validation(),
            'task' => $this->task->where('user', $user['username'])->findAll(),
            'task_berjalan' => $this->task->where(['user' => $user['username'], 'status' => 'on-going'])->orderBy('start', 'DESC')->findAll(),
            'task_selesai' => $this->task->where(['user' => $user['username'], 'status' => 'selesai'])->findAll(),
            'task_gagal' => $this->task->where(['user' => $user['username'], 'status' => 'gagal'])->findAll(),
            'all_message' =>  $this->message->where('pengirim', $user['username'])->findAll(),
            'message' => $this->message->where(['pengirim' => $user['username'], 'dibaca' => 'false'])->findAll(),
        ];

        return view('user/pesan/kirim_pesan', $data);
        
    }

    public function kirim() {

        if(!$this->validate([
            'message' => [
                'rules' => 'max_length[200]',
                'errors' => [
                    'max_length' => 'Pesan Terlalu Panjang! (jangan lebih dari 200 karakter)'
                ]
            ]
        ])) {
            return redirect()->back()->withInput();
        }

        $user = $this->user->where('id', session()->get('id_user'))->first();

        $this->message->save([
            'pengirim' => $user['username'],
            'nama_user' => $user['name'],
            'message' => $this->request->getVar('message'),
            'dibaca' => '0'
        ]);

        session()->setFlashdata('pesan', 'Berhasil Mengirim Pesan!');
        return redirect()->to('/pesan_admin');

    }

    public function lihat_pesan($id) {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $user = $this->user->where('id', session()->get('id_user'))->first();
        $this_message = $this->message->where('id', $id)->first();

        $data = [
            'title' => 'Pesan | Lihat Pesan',
            'user' => $user,
            'task' => $this->task->where('user', $user['username'])->findAll(),
            'task_berjalan' => $this->task->where(['user' => $user['username'], 'status' => 'on-going'])->orderBy('start', 'DESC')->findAll(),
            'task_selesai' => $this->task->where(['user' => $user['username'], 'status' => 'selesai'])->findAll(),
            'task_gagal' => $this->task->where(['user' => $user['username'], 'status' => 'gagal'])->findAll(),
            'all_message' =>  $this->message->where('pengirim', $user['username'])->findAll(),
            'message' => $this->message->where(['pengirim' => $user['username'], 'dibaca' => 'false'])->findAll(),
            'this_message' => $this_message
        ];

        $this->message->save([
            'id' => $id,
            'dibaca' => 'true'
        ]);

        return view('user/pesan/lihat_pesan', $data);
        
    }

}