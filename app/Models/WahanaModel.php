<?php

namespace App\Models;

use CodeIgniter\Model;

class WahanaModel extends Model
{
    protected $table = 'wahana'; // Nama tabel
    protected $primaryKey = 'id_wahana'; // Primary Key

    protected $allowedFields = ['nama_wahana', 'harga', 'kapasitas', 'status']; // Kolom-kolom yang boleh diupdate

    protected $useTimestamps = true; // Aktifkan penggunaan timestamp
    protected $createdField = 'created_at'; // Nama kolom untuk created_at
    protected $updatedField = 'updated_at'; // Nama kolom untuk updated_at
    protected $deletedField = 'deleted_at'; // Nama kolom untuk deleted_at (opsional jika Anda menggunakan soft delete)

    // Fungsi untuk mendapatkan semua data wahana
    public function getAllWahana()
    {
        return $this->findAll();
    }

    // Fungsi untuk mendapatkan wahana berdasarkan ID
    public function getWahanaById($id)
    {
        return $this->find($id);
    }

    // Fungsi untuk menambahkan wahana baru
    public function addWahana($data)
    {
        return $this->insert($data);
    }

    // Fungsi untuk mengupdate wahana
    public function updateWahana($id, $data)
    {
        return $this->update($id, $data);
    }

    // Fungsi untuk menghapus wahana
    public function deleteWahana($id)
    {
        return $this->delete($id);
    }
}
