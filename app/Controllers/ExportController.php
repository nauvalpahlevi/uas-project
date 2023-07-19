<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use App\Models\StudyModel;

class ExportController extends BaseController
{

    protected $study;

    function __construct()
    {
        $this->study = new StudyModel();
    }
    public function exportToPDF()
    {
        $data = $this->study->findAll();

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
                    <th>Instansi</th>
                    <th>Riwayat Pendidikan</th>
                    <th>Program Studi</th>
                    </tr>
                </thead>
                <tbody>';


        foreach ($data as $row) {
            $html .= '<tr>';
            $html .= '<td>' . $row['nis'] . '</td>';
            $html .= '<td>' . $row['name'] . '</td>';
            $html .= '<td>' . $row['tempat_lahir'] . '</td>';
            $html .= '<td>' . $row['tanggal_lahir'] . '</td>';
            $html .= '<td>' . $row['alamat'] . '</td>';
            $html .= '<td>' . $row['telpon'] . '</td>';
            $html .= '<td>' . $row['jurusan'] . '</td>';
            $html .= '<td>' . $row['tahun_lulus'] . '</td>';
            $html .= '<td>' . $row['kesibukan'] . '</td>';
            $html .= '<td>' . $row['instansi'] . '</td>';
            $html .= '<td>' . $row['riwayat_pendidikan'] . '</td>';
            $html .= '<td>' . $row['prodi'] . '</td>';
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
