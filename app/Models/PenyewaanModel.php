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

    /**
     * Mengambil semua data penyewaan dengan informasi wahana
     */
    public function getAllPenyewaan()
    {
        try {
            $builder = $this->select('penyewaan.*, wahana.nama_wahana, wahana.harga')
                ->join('wahana', 'wahana.id_wahana = penyewaan.id_wahana', 'left')
                ->orderBy('penyewaan.waktu_mulai', 'DESC'); // Ubah menjadi waktu_mulai agar countdown lebih relevan

            return $builder->findAll(); // Ambil semua data
        } catch (\Exception $e) {
            log_message('error', 'Query failed in getAllPenyewaan(): ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Mengambil data penyewaan berdasarkan tanggal tertentu
     * 
     * @param string $date
     * @param array $statuses
     * @return array
     */
    public function getPenyewaanByDate($date, $statuses = [])
    {
        $query = $this->where('tanggal', $date);

        if (!empty($statuses)) {
            $query = $query->whereIn('status', $statuses);
        }

        return $query->findAll();
    }

    /**
     * Mengambil data untuk countdown timer
     */
    public function getCountdownData()
    {
        return $this->select('id_penyewaan, waktu_mulai, waktu_selesai, status')->findAll();
    }

    /**
     * Memperbarui status penyewaan menjadi 'Selesai'
     * 
     * @param int $id
     * @return bool
     */
    public function updateStatus($id)
    {
        return $this->update($id, ['status' => 'Selesai']);
    }

    /**
     * Memperbarui status setelah countdown selesai
     * 
     * @param int $id
     * @return void
     */
    public function updateStatusAfterCountdown($id)
    {
        // Ambil data penyewaan berdasarkan ID
        $penyewaan = $this->find($id);

        if ($penyewaan) {
            // Set timezone ke Asia/Jakarta
            $timezone = new \DateTimeZone('Asia/Jakarta');
            $currentTime = new \DateTime('now', $timezone); // Waktu saat ini
            $waktuSelesai = new \DateTime($penyewaan['waktu_selesai'], $timezone); // Waktu selesai

            // Periksa apakah status masih 'berjalan' dan waktu selesai telah tercapai
            if ($penyewaan['status'] === 'berjalan' && $currentTime >= $waktuSelesai) {
                $this->update($id, ['status' => 'Selesai']); // Ubah status menjadi 'Selesai'
            }
        }
    }

    /**
     * Memeriksa dan memperbarui semua status penyewaan secara batch
     * 
     * @return void
     */
    public function checkAndUpdateAllStatuses()
    {
        $penyewaanList = $this->getCountdownData();

        foreach ($penyewaanList as $penyewaan) {
            $this->updateStatusAfterCountdown($penyewaan['id_penyewaan']);
        }
    }
}
