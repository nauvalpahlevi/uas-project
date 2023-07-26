<?php

namespace App\Controllers;

use App\Models\PekerjaanModel;
use App\Models\PendidikanModel;
use Dompdf\Dompdf;
use App\Models\StudyModel;

class ExportController extends BaseController
{

    protected $study;
    protected $pendidikan;
    protected $pekerjaan;

    function __construct()
    {
        $this->study = new StudyModel();
        $this->pendidikan = new PendidikanModel();
        $this->pekerjaan = new PekerjaanModel();
    }
    public function exportToPDF()
    {
        $subjects = $this->study->findAll();
        $pendidikan = $this->pendidikan->findAll();
        $pekerjaan = $this->pekerjaan->findAll();

        // Ambil konten HTML yang ingin di-export ke PDF
        $html = '<html>
                <head>
                <style>
                table {
                width: 100%;
                border-collapse: collapse;
                }

                table, th, td {
                border: 1px solid black;
                padding: 5px;
                }
                </style>
                </head>
                <body>
                <table>
                <thead>
                    <tr>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Telpon</th>
                    <th>Jurusan</th>
                    <th>Tahun Lulus</th>
                    <th>Kesibukan</th>
                    <th>Riwayat Pendidikan</th>
                    <th>Nama Kampus</th>
                    <th>Tempat Bekerja</th>
                    </tr>
                </thead>
                <tbody>';


        foreach ($subjects as $row) {
            $html .= '<tr>';
            $html .= '<td>' . $row['nis'] . '</td>';
            $html .= '<td>' . $row['name'] . '</td>';
            $html .= '<td>' . $row['tempat_lahir'] . '</td>';
            $html .= '<td>' . $row['tanggal_lahir'] . '</td>';
            $html .= '<td>' . $row['alamat'] . '</td>';
            $html .= '<td>' . $row['telpon'] . '</td>';
            $html .= '<td>' . $row['jurusan'] . '</td>';
            $html .= '<td>' . $row['tahun_lulus'] . '</td>';
            $html .= '<td>' . $row['status_kesibukan'] . '</td>';

            // Cari data pendidikan yang sesuai dengan NIS pada data subjects
            $pendidikanData = array_filter($pendidikan, function ($item) use ($row) {
                return $item['nis'] == $row['nis'];
            });

            // Cetak data pendidikan
            if (count($pendidikanData) > 0) {
                $pendidikanItem = array_shift($pendidikanData);
                $html .= '<td>' . $pendidikanItem['riwayat_pendidikan'] . '</td>';
                $html .= '<td>' . $pendidikanItem['prodi'] . '</td>';
            } else {
                // Jika tidak ada data pendidikan, cetak kolom kosong
                $html .= '<td>-</td>';
                $html .= '<td>-</td>';
            }

            // Cari data pekerjaan yang sesuai dengan NIS pada data subjects
            $pekerjaanData = array_filter($pekerjaan, function ($item) use ($row) {
                return $item['nis'] == $row['nis'];
            });

            // Cetak data pekerjaan
            if (count($pekerjaanData) > 0) {
                $pekerjaanItem = array_shift($pekerjaanData);
                $html .= '<td>' . $pekerjaanItem['instansi'] . '</td>';
            } else {
                // Jika tidak ada data pekerjaan, cetak kolom kosong
                $html .= '<td>-</td>';
            }

            $html .= '</tr>';
        }

        $html .= '</tbody>
                    </table>
                    </body>
                    </html>';


        // Gunakan library PDF (misalnya Dompdf) untuk mengonversi HTML menjadi PDF
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Simpan atau kirimkan PDF ke pengguna
        $output = $dompdf->output();
        $filename = 'data_export.pdf';
        $filepath = WRITEPATH . 'pdf/' . $filename;
        file_put_contents($filepath, $output);

        // Kembalikan tautan untuk mengunduh PDF
        return redirect()->to(base_url('export/download/' . $filename));
    }

    public function downloadPDF($filename)
    {
        $filepath = WRITEPATH . 'pdf/' . $filename;

        // Cek apakah file ada
        if (file_exists($filepath)) {
            // Mengatur header
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . filesize($filepath));

            // Membaca file dan mengirimkannya ke output
            readfile($filepath);
        } else {
            // Jika file tidak ditemukan, tampilkan pesan error atau lakukan penanganan yang sesuai
            echo 'File not found.';
        }
    }
}
