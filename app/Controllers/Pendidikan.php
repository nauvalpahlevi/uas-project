<?php

namespace App\Controllers;

use App\Models\PendidikanModel;
use App\Controllers\BaseController;

class Pendidikan extends BaseController
{
    protected $pendidikan;


    function __construct()
    {
        $this->pendidikan = new PendidikanModel();
    }
    public function addPendidikan()
    {
        // Ambil data dari form
        $riwayat_pendidikan = $this->request->getPost('riwayat_pendidikan');
        $nama_kampus = $this->request->getPost('nama_kampus');
        $tahun_masuk_kampus = $this->request->getPost('tahun_masuk_kampus');
        $tahun_lulus_kampus = $this->request->getPost('tahun_lulus_kampus');
        $prodi = $this->request->getPost('prodi');

        $data = [
            'nis' => session()->get('username'), // Ganti 'username' sesuai field yang menunjukkan user yang login
            'riwayat_pendidikan' => $riwayat_pendidikan,
            'nama_kampus' => $nama_kampus,
            'tahun_masuk_kampus' => $tahun_masuk_kampus,
            'tahun_lulus_kampus' => $tahun_lulus_kampus,
            'prodi' => $prodi
        ];

        $this->pendidikan->insert($data);

        return redirect()->to('/study/biodata')->with('success', 'Data Pendidikan berhasil ditambahkan');
    }

    public function editPendidikan($id)
    {
        $this->pendidikan->update($id, [
            'riwayat_pendidikan' => $this->request->getPost('riwayat_pendidikan'),
            'nama_kampus' => $this->request->getPost('nama_kampus'),
            'tahun_masuk_kampus' => $this->request->getPost('tahun_masuk_kampus'),
            'tahun_lulus_kampus' => $this->request->getPost('tahun_lulus_kampus'),
            'prodi' => $this->request->getPost('prodi'),
        ]);

        return redirect()->to('/study/biodata')->with('success', 'Data Pendidikan berhasil dirubah');
    }
}
