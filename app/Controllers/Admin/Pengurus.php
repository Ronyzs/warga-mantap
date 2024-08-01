<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengurusModel;

class Pengurus extends BaseController
{
    protected $pengurus;

    public function __construct()
    {
        $this->pengurus = new PengurusModel();
    }

    public function index()
    {
        return view('admin/pengurus/index', [
            'title'   => 'Data Pengurus',
            'pengurus'   => $this->pengurus->findAll(),
        ]);
    }

    public function add()
    {
        return view('admin/pengurus/form', [
            'title'      => 'Penambahan Pengurus',
            'isNew' => true,
            'validation' => \Config\Services::validation()
        ]);
    }

    public function update($id)
    {
        $pengurus = $this->pengurus->find($id);

        if ($pengurus == null) return redirect()->to('/admin/pengurus');

        return view('admin/pengurus/form', [
            'title'      => 'Update Pengurus',
            'isNew' => false,
            'id' => $id,
            'pengurus'      => $pengurus,
            'validation' => \Config\Services::validation()
        ]);
    }

    public function post()
    {
        if (!$this->validate([
            'nama' => [
                'label' => 'Nama',
                'rules'  => 'required',
            ],
            'nomor_induk' => [
                'label' => 'NIK',
                'rules'  => 'required|is_unique[pengurus.nik]|numeric',
            ],
            'rt' => [
                'label' => 'RT',
                'rules'  => 'required|numeric',
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $this->pengurus->insert([
            'nama'          => $this->request->getVar('nama'),
            'nik'         => $this->request->getVar('nomor_induk'),
            'rt'         => $this->request->getVar('rt'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('admin/pengurus');
    }

    public function put($id)
    {
        // Fetch the current NIK for the record being updated
        $currentNIK = $this->pengurus->find($id)['nik'];

        // If the NIK is being changed, enforce the uniqueness rule
        $nikRule = $this->request->getVar('nomor_induk') === $currentNIK ? 'required|numeric' : 'required|numeric|is_unique[pengurus.nik]';

        if (!$this->validate([
            'nama' => [
                'label' => 'Nama',
                'rules'  => 'required',
            ],
            'nomor_induk' => [
                'label' => 'NIK',
                'rules'  => $nikRule,
            ],
            'rt' => [
                'label' => 'RT',
                'rules'  => 'required|numeric',
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $this->pengurus->update($id, [
            'nama'          => $this->request->getVar('nama'),
            'nik'         => $this->request->getVar('nomor_induk'),
            'rt'         => $this->request->getVar('rt'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to(base_url('admin/pengurus'));
    }

    public function delete($id)
    {
        $this->pengurus->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url() . '/admin/pengurus');
    }
}
