<?php

namespace App\Models;

use CodeIgniter\Model;

class WargaModel extends Model
{
    protected $table      = 'warga';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'nik', 'nama', 'alamat', 'no_telp', 'rt', 'rw', 'jenis_kelamin', 'timses'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function distinctRtValues()
    {
        return $this->distinctValues('rt');
    }

    public function distinctRwValues()
    {
        return $this->distinctValues('rw');
    }

    public function filterByRtRw($rt, $rw)
    {
        $builder = $this->builder();

        if ($rt != '') {
            $builder->where('rt', $rt);
        }

        if ($rw != '') {
            $builder->where('rw', $rw);
        }

        return $builder->get()->getResultArray();
    }

    protected function distinctValues($column)
    {
        return $this->distinct()->select($column)->get()->getResultArray();
    }
}
