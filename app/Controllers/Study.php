<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudyModel;
use App\Models\UserModel;
use App\Models\PekerjaanModel;
use App\Models\PendidikanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Study extends BaseController
{

    protected $study;
    protected $user;
    protected $pekerjaan;
    protected $pendidikan;


    function __construct()
    {
        $this->study = new StudyModel();
        $this->user = new UserModel();
        $this->pekerjaan = new PekerjaanModel();
        $this->pendidikan = new PendidikanModel();
    }

    public function dashboard()
    {
        $data['subjects'] = $this->study->findAll();
        $data['studentCount'] = $this->study->getCount();
        $data['students'] = $this->study->findAll();
        $data['username'] = session()->get('user');
        return view('dashboard', $data);
    }

    public function data_alumni()
    {
        $data['subjects'] = $this->study->findAll();
        $data['students'] = $this->study->findAll();
        $data['username'] = session()->get('user');
        return view('data_alumni', $data);
    }

    public function save()
    {
        $nis = $this->request->getPost('nis');
        $name = $this->request->getPost('name');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        $tanggal_lahir = $this->request->getPost('tanggal_lahir');
        $alamat = $this->request->getPost('alamat');
        $telpon = $this->request->getPost('telpon');
        $email = $this->request->getPost('email');
        $jurusan = $this->request->getPost('jurusan');
        $tahun_lulus = $this->request->getPost('tahun_lulus');
        $status_kesibukan = $this->request->getPost('status_kesibukan');

        $instansi = $this->request->getPost('instansi');
        $tahun_masuk = $this->request->getPost('tahun_masuk');
        $tahun_keluar = $this->request->getPost('tahun_keluar');

        $riwayat_pendidikan = $this->request->getPost('riwayat_pendidikan');
        $nama_kampus = $this->request->getPost('nama_kampus');
        $tahun_masuk_kampus = $this->request->getPost('tahun_masuk_kampus');
        $tahun_lulus_kampus = $this->request->getPost('tahun_lulus_kampus');
        $prodi = $this->request->getPost('prodi');

        $dataStudent = [
            'nis' => $nis,
            'name' => $name,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'alamat' => $alamat,
            'telpon' => $telpon,
            'email' => $email,
            'jurusan' => $jurusan,
            'tahun_lulus' => $tahun_lulus,
            'status_kesibukan' => $status_kesibukan,
        ];

        $pekerjaanData = [
            'nis' => $nis,
            'instansi' => $instansi,
            'tahun_masuk' => $tahun_masuk,
            'tahun_keluar' => $tahun_keluar,
        ];

        $pendidikanData = [
            'nis' => $nis,
            'riwayat_pendidikan' => $riwayat_pendidikan,
            'nama_kampus' => $nama_kampus,
            'tahun_masuk_kampus' => $tahun_masuk_kampus,
            'tahun_lulus_kampus' => $tahun_lulus_kampus,
            'prodi' => $prodi,
        ];

        try {
            // Insert data into 'student' table
            $this->study->insert($dataStudent);

            // Insert data into 'user' table
            $this->user->createUserWithDefaultPassword($nis);

            // Insert data into 'pekerjaan' table
            $this->pekerjaan->insert($pekerjaanData);

            // Insert data into 'pendidikan' table
            $this->pendidikan->insert($pendidikanData);

            return redirect()->to('study/data_alumni')->with('success', 'Data has been successfully saved.');
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->with('error', 'Failed to save data. Please try again.');
        }
    }


    public function downloadExcel()
    {
        $subjects = $this->study->findAll();
        $pendidikan = $this->pendidikan->findAll();
        $pekerjaan = $this->pekerjaan->findAll();

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
        $sheet->setCellValue('J1', 'Status Kesibukan');
        $sheet->setCellValue('K1', 'Instansi');
        $sheet->setCellValue('L1', 'Tahun Masuk Instansi');
        $sheet->setCellValue('M1', 'Tahun Keluar Instansi');
        $sheet->setCellValue('N1', 'Riwayat Pendidikan');
        $sheet->setCellValue('O1', 'Nama Kampus');
        $sheet->setCellValue('P1', 'Tahun Masuk Kampus');
        $sheet->setCellValue('Q1', 'Tahun Lulus Kampus');
        $sheet->setCellValue('R1', 'Program Studi');

        $row = 2;

        // Menyatukan data dari ketiga tabel menjadi satu array untuk setiap barisnya
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
            $sheet->setCellValue('J' . $row, $subject['status_kesibukan']);

            // Ambil data pekerjaan untuk baris yang sesuai
            if (isset($pekerjaan[$row - 2])) {
                $sheet->setCellValue('K' . $row, $pekerjaan[$row - 2]['instansi']);
                $sheet->setCellValue('L' . $row, $pekerjaan[$row - 2]['tahun_masuk']);
                $sheet->setCellValue('M' . $row, $pekerjaan[$row - 2]['tahun_keluar']);
            }

            // Ambil data pendidikan untuk baris yang sesuai
            if (isset($pendidikan[$row - 2])) {
                $sheet->setCellValue('N' . $row, $pendidikan[$row - 2]['riwayat_pendidikan']);
                $sheet->setCellValue('O' . $row, $pendidikan[$row - 2]['nama_kampus']);
                $sheet->setCellValue('P' . $row, $pendidikan[$row - 2]['tahun_masuk_kampus']);
                $sheet->setCellValue('Q' . $row, $pendidikan[$row - 2]['tahun_lulus_kampus']);
                $sheet->setCellValue('R' . $row, $pendidikan[$row - 2]['prodi']);
            }

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

                    // Simpan data ke tabel studi
                    $dataStudy = [
                        'nis'               => $row[0],
                        'name'              => $row[1],
                        'tempat_lahir'      => $row[2],
                        'tanggal_lahir'     => $row[3],
                        'alamat'            => $row[4],
                        'telpon'            => $row[5],
                        'email'             => $row[6],
                        'jurusan'           => $row[7],
                        'tahun_lulus'       => $row[8],
                        'status_kesibukan'  => $row[9],
                    ];
                    $this->study->upsert($dataStudy, 'nis'); // Ganti 'nis' dengan kolom yang merupakan primary key

                    // Simpan data ke tabel pekerjaan
                    $dataPekerjaan = [
                        'nis'           => $row[0],
                        'instansi'      => $row[10],
                        'tahun_masuk'   => $row[11],
                        'tahun_keluar'  => $row[12],
                    ];
                    $this->pekerjaan->upsert($dataPekerjaan, 'nis'); // Ganti 'nis' dengan kolom yang merupakan primary key

                    // Simpan data ke tabel pendidikan
                    $dataPendidikan = [
                        'nis'                   => $row[0],
                        'riwayat_pendidikan'    => $row[13],
                        'nama_kampus'           => $row[14],
                        'tahun_masuk_kampus'    => $row[15],
                        'tahun_lulus_kampus'    => $row[16],
                        'prodi'                 => $row[17],
                    ];
                    $this->pendidikan->upsert($dataPendidikan, 'nis'); // Ganti 'nis' dengan kolom yang merupakan primary key

                    $this->user->createUserWithDefaultPassword($row[0]);
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
        // Ambil data yang diinputkan oleh pengguna
        $nis = $this->request->getPost('nis');
        $password = $this->request->getPost('password');

        // Cek apakah pengguna dengan NIS tersebut ada di database
        $user = $this->user->where('username', $nis)->first();

        if ($user) {
            // Jika pengguna dengan NIS tersebut ditemukan, verifikasi password
            if ($password === $user['password'] or password_verify($password, $user['password'])) {
                // Password cocok, atur sesi pengguna dan arahkan ke halaman dashboard atau halaman lain yang sesuai
                $student = $this->study->where('nis', $nis)->first();
                if ($user['role'] === 'admin') {
                    // Simpan data pengguna dalam sesi
                    $session = session();
                    $userData = [
                        'username' => $user['username'],
                        'role' => $user['role'],
                    ];
                    $session->set($userData);

                    return redirect()->to('study/dashboard');
                } else if ($student) {
                    if ($user['role'] === 'user') {
                        // Retrieve the pendidikan and pekerjaan data for users
                        $pendidikan = $this->pendidikan->where('nis', $nis)->first();
                        $pekerjaan = $this->pekerjaan->where('nis', $nis)->first();

                        if ($pendidikan && $pekerjaan) {
                            // Simpan data pengguna dalam sesi
                            $session = session();
                            $userData = [
                                'id' => $user['id'],
                                'username' => $user['username'],
                                'role' => $user['role'],
                                'name' => $student['name'],
                                'tempat_lahir' => $student['tempat_lahir'],
                                'tanggal_lahir' => $student['tanggal_lahir'],
                                'alamat' => $student['alamat'],
                                'telpon' => $student['telpon'],
                                'email' => $student['email'],
                                'jurusan' => $student['jurusan'],
                                'tahun_lulus' => $student['tahun_lulus'],
                                'riwayat_pendidikan' => $pendidikan['riwayat_pendidikan'],
                                'nama_kampus' => $pendidikan['nama_kampus'],
                                'tahun_masuk_kampus' => $pendidikan['tahun_masuk_kampus'],
                                'tahun_lulus_kampus' => $pendidikan['tahun_lulus_kampus'],
                                'instansi' => $pekerjaan['instansi'],
                                'tahun_masuk' => $pekerjaan['tahun_masuk'],
                                'tahun_keluar' => $pekerjaan['tahun_keluar'],
                            ];
                            $session->set($userData);

                            return redirect()->to('study/dashboard');
                        } else {
                            return redirect()->back()->with('error', 'Pendidikan data or Pekerjaan data not found');
                        }
                    } else {
                        // Handle other user roles here, if needed
                    }
                } else {
                    return redirect()->back()->with('error', 'Student data not found');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid password');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Username');
        }
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

    function biodata()
    {
        $data['subjects'] = $this->study->findAll();
        return view('biodata', $data);
    }
}
