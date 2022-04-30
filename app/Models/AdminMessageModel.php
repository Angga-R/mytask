<?php 

namespace App\Models;

use CodeIgniter\Model;

class AdminMessageModel extends Model {

    protected $table = 'admin_message';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'pengirim', 'nama_user', 'message', 'balasan', 'created_at', 'updated_at']; // ini untuk memberitahukan data apa saja yang boleh diisi

}

?>