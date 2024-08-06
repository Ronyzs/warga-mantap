<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\WargaModel;

class User extends BaseController
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
      'warga'   => $this->warga->getWargaWithPengurus(),
    ]);
  }
}
