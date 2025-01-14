<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table      = 'setting';
    protected $primaryKey = 'id_setting';
    protected $allowedFields = ['namawebsite', 'icontab', 'iconlogin', 'iconmenu'];
    protected $useTimestamps = true;

    // Update the settings
    public function updateSettings($data, $id)
    {
        return $this->update($id, $data);
    }
}
