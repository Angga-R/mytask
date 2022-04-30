<?php 

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\TaskModel;
use App\Models\UserModel;

class Home extends BaseController {

    protected $user;
    protected $task;

    public function __construct()
    {
        $this->user = new UserModel();
        $this->task = new TaskModel();
    }

    public function index() {

        if(!session()->has('logged_user')) {
            return redirect()->to('/login');
        }

    }

}

?>