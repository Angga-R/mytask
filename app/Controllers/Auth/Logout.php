<?php

namespace App\Controllers\Auth;
use App\Controllers\BaseController;

class Logout extends BaseController {

    public function index() {

        session()->destroy();
        setcookie('admin', '', 0, '');
        setcookie('user', '', 0, '');
        return redirect()->to('/login');

    }

}

?>