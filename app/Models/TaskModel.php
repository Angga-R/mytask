<?php 

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model {

    protected $table = 'task';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'user', 'content', 'start', 'end', 'status']; // ini untuk memberitahukan data apa saja yang boleh diisi


}

?>