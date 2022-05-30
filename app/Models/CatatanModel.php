<?php 

namespace App\Models;

use CodeIgniter\Model;

class CatatanModel extends Model {

    protected $table = 'catatan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'user', 'content', 'dibuat_pada']; // ini untuk memberitahukan data apa saja yang boleh diisi


}

?>