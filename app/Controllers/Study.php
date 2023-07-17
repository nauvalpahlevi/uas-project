<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudyModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Study extends BaseController
{

    protected $study;

    function __construct()
    {
        $this->study = new StudyModel();
    }

    public function dashboard()
    {
        $data['subjects'] = $this->study->findAll();
        $data['studentCount'] = $this->study->getCount();
        $data['bekerja'] = $this->study->getCountByCategory('bekerja');
        $data['wirausaha'] = $this->study->getCountByCategory('wirausaha');
        $data['kuliah'] = $this->study->getCountByCategory('kuliah');
        $data['username'] = session()->get('user');
        return view('dashboard', $data);
    }
    public function data_alumni()
    {
        $data['subjects'] = $this->study->findAll();
        $data['username'] = session()->get('user');
        return view('data_alumni', $data);
    }

    // public function index()
    // {
    //     $data['username'] = session()->get('username');
    //     $data['subjects'] = $this->study->findAll();
    //     return view('dashboard', $data);
    // }

    public function save()
    {
        $this->study->insert([
            'nis' => $this->request->getPost('nis'),
            'name' => $this->request->getPost('name'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'alamat' => $this->request->getPost('alamat'),
            'telpon' => $this->request->getPost('telpon'),
            'email' => $this->request->getPost('email'),
            'jurusan' => $this->request->getPost('jurusan'),
            'tahun_lulus' => $this->request->getPost('tahun_lulus'),
            'kesibukan' => $this->request->getPost('kesibukan'),
            'instansi' => $this->request->getPost('instansi'),
            'riwayat_pendidikan' => $this->request->getPost('riwayat_pendidikan'),
            'prodi' => $this->request->getPost('prodi')
        ]);
        return redirect()->to('/study/data_alumni')->with('success', 'Data Added Successfully');
    }

    public function downloadExcel()
    {
        $subjects = $this->study->findAll();

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
        $sheet->setCellValue('N1', 'Password');

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
            $sheet->setCellValue('M' . $row, $subject['password']);
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

                $model = new StudyModel();

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

                    $model->upsert($data, 'nis'); // Ganti 'nis' dengan kolom yang merupakan primary key

                }

                return redirect()->to('/study/data_alumni')->with('success', 'Data Imported Successfully');
            }
        }
        return redirect()->back()->with('error', 'Invalid file or format');
    }

    function home()
    {
        echo view('template/header');
        echo view('homepage');
        echo view('template/footer');
    }
    function informasi()
    {
        echo view('template/header');
        echo view('informasi');
        echo view('template/footer');
    }
    function visi_misi()
    {
        echo view('template/header');
        echo view('visimisi');
        echo view('template/footer');
    }

    function login()
    {
        echo view('template/headerlogin');
        echo view('loginpage');
        echo view('template/footer');
    }

    public function auth()
    {
        $nis = $this->request->getPost('nis');
        $password = $this->request->getPost('password');

        $user = $this->study->where('nis', $nis)->first();

        if (!$user || !password_verify($password, $user['pass'])) {
            session()->setFlashdata('error', 'Silahkan cek kembali Nis dan Password Anda');
            return redirect()->back()->withInput();
        }

        // Set user session
        $userData = [
            'nis' => $user['nis'],
            'name' => $user['name']
            // Add more data as needed
        ];
        session()->set($userData);

        return redirect()->to('study/dashboard'); // Redirect to dashboard or desired page after successful login
    }

    public function edit($id)
    {
        $this->study->update($id, [
            'name' => $this->request->getPost('name'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'alamat' => $this->request->getPost('alamat'),
            'telpon' => $this->request->getPost('telpon'),
            'email' => $this->request->getPost('email'),
            'jurusan' => $this->request->getPost('jurusan'),
            'tahun_lulus' => $this->request->getPost('tahun_lulus'),
            'kesibukan' => $this->request->getPost('kesibukan'),
            'instansi' => $this->request->getPost('instansi'),
            'riwayat_pendidikan' => $this->request->getPost('riwayat_pendidikan'),
            'prodi' => $this->request->getPost('prodi'),
        ]);

        return redirect()->to('/study/data_alumni')->with('success', 'Data Updated Successfully');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/study/home');
    }

    public function delete($id)
    {
        $this->study->delete($id);
        return redirect()->to('/study/data_alumni');
    }
}
