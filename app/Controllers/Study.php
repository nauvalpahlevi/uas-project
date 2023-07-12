<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudyModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Study extends BaseController
{

    public function dashboard()
    {
        $model = new StudyModel();
        $data['subjects'] = $model->findAll();
        return view('dashboard', $data);
    }
    public function data_alumni()
    {
        $model = new StudyModel();
        $data['subjects'] = $model->findAll();
        return view('data_alumni', $data);
    }

    public function index()
    {
        $model = new StudyModel();
        $data['subjects'] = $model->findAll();

        return view('dashboard', $data);
    }

    public function add()
    {
        return view('add');
    }

    // public function save()
    // {
    //     $model = new SubjectModel();

    //     $data = [
    //         'name' => $this->request->getPost('name'),
    //         'hours_studied' => $this->request->getPost('hours_studied'),
    //     ];

    //     $model->insert($data);

    //     return redirect()->to('/subjects');
    // }

    public function downloadExcel()
    {
        $model = new StudyModel();
        $subjects = $model->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Nis');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Tempat Lahir');
        $sheet->setCellValue('D1', 'Tanggal Lahir');
        $sheet->setCellValue('E1', 'Alamat');
        $sheet->setCellValue('F1', 'Telpon');
        $sheet->setCellValue('G1', 'Email');
        $sheet->setCellValue('H1', 'Jurusan');
        $sheet->setCellValue('I1', 'Tahun Lulusan');
        $sheet->setCellValue('J1', 'Kesibukan');
        $sheet->setCellValue('K1', 'Instansi');
        $sheet->setCellValue('L1', 'Riwayat Pendidikan');
        $sheet->setCellValue('M1', 'Program Studi');

        $row = 2;
        foreach ($subjects as $subject) {
            $sheet->setCellValue('A' . $row, $subject['nis']);
            $sheet->setCellValue('B' . $row, $subject['name']);
            $sheet->setCellValue('C' . $row, $subject['tempat_lahir']);
            $sheet->setCellValue('D' . $row, $subject['tanggal_lahir']);
            $sheet->setCellValue('E' . $row, $subject['alamat']);
            $sheet->setCellValue('F' . $row, $subject['telpon']);
            $sheet->setCellValue('G' . $row, $subject['email']);
            $sheet->setCellValue('H' . $row, $subject['jurusan']);
            $sheet->setCellValue('I' . $row, $subject['tahun_lulus']);
            $sheet->setCellValue('J' . $row, $subject['kesibukan']);
            $sheet->setCellValue('K' . $row, $subject['instansi']);
            $sheet->setCellValue('L' . $row, $subject['riwayat_pendidikan']);
            $sheet->setCellValue('M' . $row, $subject['prodi']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        $filename = 'Students.xlsx';
        $temp_file = tmpfile();
        $path = stream_get_meta_data($temp_file)['uri'];
        $writer->save($path);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));

        readfile($path);
        exit;
    }

    public function importExcel()
    {
        if ($this->request->getMethod() === 'post' && $this->request->getFile('excel_file')) {
            $file = $this->request->getFile('excel_file');

            if ($file->isValid() && $file->getExtension() === 'xlsx') {
                $spreadsheet = IOFactory::load($file->getPathname());
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();

                $startRow = 2;
                $endRow = count($rows);


                for ($rowIndex = $startRow; $rowIndex <= $endRow; $rowIndex++) {
                    $row = $rows[$rowIndex - 1];

                    $data = [
                        'nis'                   => $row[0],
                        'name'                  => $row[1],
                        'tempat_lahir'          => $row[2],
                        'tanggal_lahir'         => $row[3],
                        'alamat'                => $row[4],
                        'telpon'                => $row[5],
                        'email'                 => $row[6],
                        'jurusan'               => $row[7],
                        'tahun_lulus'           => $row[8],
                        'kesibukan'             => $row[9],
                        'instansi'              => $row[10],
                        'riwayat_pendidikan'    => $row[11],
                        'prodi'                 => $row[12],
                    ];

                    $model = new StudyModel();
                    $model->insert($data);
                }

                return redirect()->to('/study/data_alumni')->with('success', 'Data imported successfully');
            }
        }
        return redirect()->back()->with('error', 'Invalid file or format');
    }
}