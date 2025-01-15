<?php

namespace App\Models;

use CodeIgniter\Model;

class PenyewaanModel extends Model
{
    protected $table = 'penyewaan'; // Nama tabel
    protected $primaryKey = 'id_penyewaan'; // Primary key

    protected $allowedFields = [
        'id_wahana',
        'tanggal',
        'waktu_mulai',
        'durasi',
        'total',
        'status',
        'nama_ortu',
        'nohp',
        'nama_anak'
    ]; // Kolom-kolom yang diizinkan untuk diisi

    protected $useTimestamps = true; // Aktifkan timestamps
    protected $createdField = 'created_at'; // Kolom created_at
    protected $updatedField = 'updated_at'; // Kolom updated_at
}
