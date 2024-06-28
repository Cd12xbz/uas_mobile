<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class PembayaranController extends ResourceController
{
    protected $modelName = 'App\Models\Pembayaran';
    protected $format    ='json';
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        //
        $data = [
            'message' => 'success',
            'data_pembayaran' => $this->model->orderBy('pembayaran.id','DESC')->getPembayaranWithSiswa()
        ];

        return $this->respond($data, 200);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($nis_siswa = null)
    {
        $data = $this->model->orderBy('pembayaran.id','DESC')->getPembayaranWithSiswaByNis($nis_siswa);

        if (!$data) {
            return $this->failNotFound('Data not found');
        }

        return $this->respond($data, 200);
    }


    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
        $siswaModel = new \App\Models\Siswa();

        $nis_siswa = $this->request->getVar('nis_siswa');
        $nominal = $this->request->getVar('nominal');
        $berita = $this->request->getVar('berita');

        // Cek apakah siswa dengan NIS tersebut ada
        $siswa = $siswaModel->find($nis_siswa);

        if (!$siswa) {
            return $this->fail('Siswa not found for NIS: ' . $nis_siswa, 404);
        }

        // Data pembayaran yang akan disimpan
        $data = [
            'nis_siswa' => $nis_siswa,
            'nominal' => $nominal,
            'berita' => $berita
        ];

        // Simpan data pembayaran
        $this->model->insert($data);

        // Ambil data pembayaran yang baru saja disimpan beserta nama siswa
        $newPayment = $this->model->select('pembayaran.*, siswa.nama_siswa')
                                 ->join('siswa', 'siswa.nis = pembayaran.nis_siswa')
                                 ->where('pembayaran.id', $this->model->getInsertID())
                                 ->first();

        return $this->respondCreated([
            'message' => 'Pembayaran created successfully',
            'data' => $newPayment
        ]);
    }


    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
        $rules = $this->validate([
            'nis_siswa'  => 'required',
            'nominal'    => 'required',
            'berita'     => 'required',
        ]);

        if(!$rules)
        {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }


        // Update data pembayaran
        $this->model->update($id,[
            'nis_siswa' => esc($this->request->getVar('nis_siswa')),
            'nominal'   => esc($this->request->getVar('nominal')),
            'berita'    => esc($this->request->getVar('berita')),
        ]);

        // Ambil data pembayaran yang baru saja diupdate beserta nama siswa
        $updatedPayment = $this->model->select('pembayaran.*, siswa.nama_siswa')
                                    ->join('siswa', 'siswa.nis = pembayaran.nis_siswa')
                                    ->where('pembayaran.id', $id)
                                    ->first();

        return $this->respondUpdated([
            'message' => 'Pembayaran updated successfully',
            'data' => $updatedPayment
        ]);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
        // Cek keberadaan data pembayaran
        $payment = $this->model->find($id);
        if (!$payment) {
            return $this->failNotFound('Payment not found');
        }

        // Lakukan proses penghapusan data
        $this->model->delete($id);

        return $this->respondDeleted([
            'message' => 'Pembayaran deleted successfully',
            'data' => $payment
        ]);
    }
}
