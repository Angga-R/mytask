<?php 

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model {

    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'username', 'nama', 'foto', 'tentang', 'email', 'link_portfolio', 'password']; // ini untuk memberitahukan data apa saja yang boleh diisi

}

?>