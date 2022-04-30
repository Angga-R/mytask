<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginUserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'username', 'name', 'gender', 'password', 'pertanyaan_keamanan', 'jawaban_keamanan', 'created_at', 'updated_at']; // ini untuk memberitahukan data apa saja yang boleh diisi

}