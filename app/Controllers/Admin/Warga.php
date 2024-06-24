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

    public function add()
    {
        return view('admin/warga-add', [
            'title'      => 'Tambah Warga',
            'validation' => \Config\Services::validation()
        ]);
    }

    public function update($id)
    {
        $warga = $this->warga->find($id);

        if ($warga == null) return redirect()->to('/admin/warga');

        return view('admin/warga-update', [
            'title'      => 'Update Warga',
            'warga'      => $warga,
            'validation' => \Config\Services::validation()
        ]);
    }

    public function post()
    {
        if (!$this->validate([
            'nomor_induk' => [
                'rules'  => 'required|is_unique[warga.nik]',
                'errors' => [
                    'is_unique' => 'NIK sudah terdaftar.',
                    'required' => 'NIK harus diisi.'
                ]
            ],
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi.'
                ]
            ],
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi.'
                ]
            ],
            'no_telp' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'No. Telp harus diisi.',
                    'integer'  => 'Harus berupa angka.'
                ]
            ],
            'rt' => [
                'rules'  => 'required|integer',
                'errors' => [
                    'required' => 'RT harus diisi.',
                    'integer'  => 'Harus berupa angka.'
                ]
            ],
            'rw' => [
                'rules'  => 'required|integer',
                'errors' => [
                    'required' => 'RW harus diisi.',
                    'integer'  => 'Harus berupa angka.'
                ]
            ],
            'jenis_kelamin' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jenis kelamin harus diisi.'
                ]
            ],
            'timses' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Timses harus diisi.'
                ]
            ],
        ])) {
            // dd(\Config\Services::validation()->hasError('nik'));
            return redirect()->back()->withInput();
        }



        $this->warga->insert([
            'nik'          => $this->request->getVar('nomor_induk'),
            'nama'         => $this->request->getVar('nama'),
            'alamat'       => $this->request->getVar('alamat'),
            'no_telp'      => $this->request->getVar('no_telp'),
            'rt'           => $this->request->getVar('rt'),
            'rw'           => $this->request->getVar('rw'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'timses'       => $this->request->getVar('timses'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('admin/warga');
    }

    public function put($id)
    {
        // Fetch the current NIK for the record being updated
        $currentNIK = $this->warga->find($id)['nik'];

        // If the NIK is being changed, enforce the uniqueness rule
        $nikRule = $this->request->getVar('nik') === $currentNIK ? 'required' : 'required|is_unique[warga.nik]';

        if (!$this->validate([
            'nik' => [
                'rules'  => $nikRule,
                'errors' => [
                    'required' => 'NIK harus diisi.',
                    'is_unique' => 'NIK sudah terdaftar.'
                ]
            ],
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi.'
                ]
            ],
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Alamat harus diisi.'
                ]
            ],
            'no_telp' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => 'No. Telp harus diisi.',
                    'integer'  => 'Harus berupa angka.'
                ]
            ],
            'rt' => [
                'rules'  => 'required|integer',
                'errors' => [
                    'required' => 'RT harus diisi.',
                    'integer'  => 'Harus berupa angka.'
                ]
            ],
            'rw' => [
                'rules'  => 'required|integer',
                'errors' => [
                    'required' => 'RW harus diisi.',
                    'integer'  => 'Harus berupa angka.'
                ]
            ],
            'jenis_kelamin' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Jenis kelamin harus diisi.'
                ]
            ],
            'timses' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Timses harus diisi.'
                ]
            ],
        ])) {
            return redirect()->back()->withInput();
        }

        $this->warga->update($id, [
            'nik'          => $this->request->getVar('nik'),
            'nama'         => $this->request->getVar('nama'),
            'alamat'       => $this->request->getVar('alamat'),
            'no_telp'      => $this->request->getVar('no_telp'),
            'rt'           => $this->request->getVar('rt'),
            'rw'           => $this->request->getVar('rw'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'timses'       => $this->request->getVar('timses'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to(base_url('admin/warga'));
    }

    public function delete($id)
    {
        $this->warga->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to(base_url() . '/admin/warga');
    }
}
