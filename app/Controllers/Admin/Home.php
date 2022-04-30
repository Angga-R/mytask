<?php 

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Controllers\BaseController;
use App\Models\AdminMessageModel;
use App\Models\AdminModel;
use App\Models\RencanaPengembanganModel;
use App\Models\TaskModel;

class Home extends BaseController {

    protected $user;
    protected $task;
    protected $adminMessage;
    protected $pengembangan;
    protected $dataAdmin;

    public function __construct()
    {
        $this->user = new UserModel();
        $this->task = new TaskModel();
        $this->adminMessage = new AdminMessageModel();
        $this->pengembangan = new RencanaPengembanganModel();
        $this->dataAdmin = new AdminModel();
    }
    
    public function index() {
        
        if (!session()->has('logged_admin')) {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Index | Admin',
            'data_admin' => $this->dataAdmin->where('id', session()->get('id_admin'))->first(),
            'user' => $this->user->findAll(),
            'task' => $this->task->findAll(),
            'message' => $this->adminMessage->findAll(),
            'rencana' => $this->pengembangan->where('status', 'belum selesai')->findAll(),
            'rencana_end' => $this->pengembangan->where('status', 'selesai')->findAll(),
            'rencana_gagal' => $this->pengembangan->where('status', 'gagal')->findAll()
        ];

        return view('admin/index', $data);
    }

}

?>