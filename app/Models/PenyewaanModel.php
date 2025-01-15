<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyewaanModel extends Model
{
    protected $table = 'penyewaan';
    protected $primaryKey = 'id_penyewaan';
    protected $allowedFields = [
        'id_wahana',
        'tanggal',
        'waktu_mulai',
        'durasi',
        'waktu_selesai',
        'total',
        'status',
        'nama_ortu',
        'nohp',
        'nama_anak',
    ];

    public function getAllPenyewaan()
    {
        return $this->select('penyewaan.*, wahana.nama_wahana, wahana.harga')
            ->join('wahana', 'wahana.id_wahana = penyewaan.id_wahana', 'left')
            ->orderBy('penyewaan.created_at', 'DESC')
            ->findAll();
    }
}
