<?php 

namespace App\Models;

use CodeIgniter\Model;

class RencanaPengembanganModel extends Model {

    protected $table = 'rencana_pengembangan';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'isi_rencana', 'status', 'tgl_selesai', 'created_at', 'updated_at']; // ini untuk memberitahukan data apa saja yang boleh diisi

}

?>