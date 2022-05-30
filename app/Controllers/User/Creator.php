<?php 

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\AdminMessageModel;
use App\Models\TaskModel;
use App\Models\CatatanModel;
use App\Models\UserModel;
use App\Models\AdminModel;

class Creator extends BaseController {

    protected $user;
    protected $task;
    protected $catatan;
    protected $message;
    protected $admin;

    public function __construct()
    {
        $this->user = new UserModel();
        $this->task = new TaskModel();
        $this->catatan = new CatatanModel();
        $this->message = new AdminMessageModel();
        $this->admin = new AdminModel();
    }

    public function index() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/');
        }

        $user = $this->user->where('id', session()->get('id_user'))->first();

        $data = [
            'title' => 'MyTask',
            'user' => $user,
            'task' => $this->task->where('user', $user['username'])->findAll(),
            'task_berjalan' => $this->task->where(['user' => $user['username'], 'status' => 'on-going'])->findAll(),
            'task_selesai' => $this->task->where(['user' => $user['username'], 'status' => 'selesai'])->findAll(),
            'task_gagal' => $this->task->where(['user' => $user['username'], 'status' => 'gagal'])->findAll(),
            'all_message' =>  $this->message->where('pengirim', $user['username'])->findAll(),
            'message' => $this->message->where(['pengirim' => $user['username'], 'dibaca' => 'false'])->findAll(),
            'catatan' => $this->catatan->where('user', $user['username'])->findAll(),
            'creator' => $this->admin->first()
        ];

        return view('user/creator', $data);

    }

}

?>