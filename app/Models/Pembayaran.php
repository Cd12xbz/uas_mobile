<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembayaran extends Model
{
    protected $table            = 'pembayaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nis_siswa','nominal','berita'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Function to get pembayaran with related siswa data
    public function getPembayaranWithSiswa()
    {
        return $this->select('pembayaran.*, siswa.nama_siswa')
                    ->join('siswa', 'siswa.nis = pembayaran.nis_siswa')
                    ->findAll();
    }

    public function getPembayaranWithSiswaByNis($nis_siswa)
    {
        return $this->select('pembayaran.*, siswa.nama_siswa')
                    ->join('siswa', 'siswa.nis = pembayaran.nis_siswa')
                    ->where('pembayaran.nis_siswa', $nis_siswa)
                    ->findAll();
    }
    public function getPembayaranWithSiswaByTanggal($tanggal)
    {
    return $this->select('pembayaran.id, pembayaran.tanggal, pembayaran.nis_siswa,
                          siswa.nama_siswa, pembayaran.nominal, pembayaran.berita')
                ->join('siswa', 'siswa.nis = pembayaran.nis_siswa')
                ->where('DATE(pembayaran.tanggal)', $tanggal)
                ->orderBy('pembayaran.id', 'DESC')
                ->findAll();
    }

}
