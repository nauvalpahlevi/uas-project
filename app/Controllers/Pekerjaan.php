<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PekerjaanModel;

class Pekerjaan extends BaseController
{
    protected $pekerjaan;

    function __construct()
    {
        $this->pekerjaan = new PekerjaanModel();
    }
    public function addPekerjaan()
    {
        // Ambil data dari form
        $instansi = $this->request->getPost('instansi');
        $tahun_masuk = $this->request->getPost('tahun_masuk');
        $tahun_keluar = $this->request->getPost('tahun_keluar');

        $data = [
            'nis' => session()->get('username'), // Ganti 'username' sesuai field yang menunjukkan user yang login
            'instansi' => $instansi,
            'tahun_masuk' => $tahun_masuk,
            'tahun_keluar' => $tahun_keluar,
        ];

        $this->pekerjaan->insert($data);

        return redirect()->to('/study/biodata')->with('success', 'Data Pekerjaan berhasil ditambahkan');
    }

    public function editPekerjaan($id)
    {
        $this->pekerjaan->update($id, [
            'instansi' => $this->request->getPost('instansi'),
            'tahun_masuk' => $this->request->getPost('tahun_masuk'),
            'tahun_keluar' => $this->request->getPost('tahun_keluar'),
        ]);

        return redirect()->to('/study/biodata')->with('success', 'Data Pekerjaan berhasil dirubah');
    }
}
