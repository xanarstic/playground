<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = [
        'no_transaksi',
        'id_penyewaan',
        'total',
        'bayar',
        'kembalian',
        'payment'
    ];
}
