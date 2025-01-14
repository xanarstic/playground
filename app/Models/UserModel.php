<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = [
        'username',
        'password',
        'level',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
