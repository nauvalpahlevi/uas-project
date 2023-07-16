<?php

namespace App\Models;

use CodeIgniter\Model;

class StudyModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'students';
    protected $primaryKey       = 'nis';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nis', 'name', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'telpon', 'email', 'jurusan', 'tahun_lulus', 'kesibukan', 'instansi', 'riwayat_pendidikan', 'prodi'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getCount()
    {
        return $this->countAllResults();
    }

    public function getCountByCategory($category)
    {
        return $this->where('kesibukan', $category)->countAllResults();
    }
}
