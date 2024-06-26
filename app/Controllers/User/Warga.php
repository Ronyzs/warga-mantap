<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WargaModel;

class Warga extends BaseController
{
    protected $warga;

    public function __construct()
    {
        $this->warga = new WargaModel();
    }

    public function index()
    {
        return view('user/warga', [
            'title'   => 'Data Warga',
            'warga'   => $this->warga->findAll(),
        ]);
    }
}
