<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WargaModel;

class Admin extends BaseController
{
  protected $warga;

  public function __construct()
  {
    $this->warga = new WargaModel();
  }
  public function index()
  {
    return view('admin/warga', [
      'title'   => 'Data Warga',
      'warga'   => $this->warga->findAll(),
      'rts' => array_map(function ($b) {
        return $b['rt'];
      }, $this->warga->distinctRtValues()),
      'rws' => array_map(function ($b) {
        return $b['rw'];
      }, $this->warga->distinctRwValues())
    ]);
  }
}
