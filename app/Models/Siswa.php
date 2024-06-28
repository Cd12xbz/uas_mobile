<?php

namespace App\Models;

use CodeIgniter\Model;

class Siswa extends Model
{
    protected $table            = 'siswa';
    protected $primaryKey       = 'nis';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [];


    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Function to get pembayaran with related siswa data
    public function getSiswaWithPembayaran()
    {
        return $this->select('pembayaran.id, siswa.*, pembayaran.tanggal, pembayaran.nominal, pembayaran.berita')
                    ->join('pembayaran', 'pembayaran.nis_siswa = siswa.nis')
                    ->findAll();
    }
    public function getSiswaWithPembayaranByNis($nis)
    {
        return $this->select('pembayaran.id, siswa.*, pembayaran.tanggal, pembayaran.nominal, pembayaran.berita')
                    ->join('pembayaran', 'pembayaran.nis_siswa = siswa.nis')
                    ->where('siswa.nis', $nis)
                    ->findAll();
    }
}
