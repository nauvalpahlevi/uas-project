<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'password', 'role'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function createUserWithDefaultPassword($nis)
    {
        // Ambil 6 angka terakhir dari NIS sebagai password default
        $defaultPassword = substr($nis, -6);

        // Hash password default menggunakan password_hash
        $hashedPassword = password_hash($defaultPassword, PASSWORD_DEFAULT);

        // Simpan data user baru ke dalam database
        $data = [
            'username' => $nis, // Misalkan NIS digunakan sebagai username
            'password' => $hashedPassword,
            'role' => 'user' // Role default bisa disesuaikan
        ];

        return $this->replace($data);
    }
}
