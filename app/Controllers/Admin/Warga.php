<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PengurusModel;
use App\Models\WargaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Warga extends BaseController
{
    protected $warga, $pengurus;

    public function __construct()
    {
        $this->warga = new WargaModel();
        $this->pengurus = new PengurusModel();
    }

    public function index()
    {
        return view('admin/warga/index', [
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

    function getPengurusById($id)
    {
        return $this->response->setJSON($this->pengurus->find($id));
    }

    function getListPengurus()
    {
        return $this->pengurus->findAll();
    }

    public function add()
    {
        return view('admin/warga/form', [
            'title'      => 'Tambah Warga',
            'pengurus' => $this->pengurus->getListPengurus(),
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
                'label'  => 'NIK',
                'rules'  => 'required|is_unique[warga.nik]|numeric',
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

    public function exportExcel()
    {
        $data = $this->warga->getWargaWithPengurus(); // Get all data from the model

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the header row
        $sheet->setCellValue('A1', 'NO');
        $sheet->setCellValue('B1', 'NIK');
        $sheet->setCellValue('C1', 'Nama');
        $sheet->setCellValue('D1', 'Alamat');
        $sheet->setCellValue('E1', 'No Telp');
        $sheet->setCellValue('F1', 'RT');
        $sheet->setCellValue('G1', 'RW');
        $sheet->setCellValue('H1', 'Jenis Kelamin');
        $sheet->setCellValue('I1', 'Pengurus');

        // Populate the sheet with data
        $row = 2;
        foreach ($data as $key => $item) {
            $sheet->setCellValue('A' . $row, $key + 1);
            $sheet->setCellValue('B' . $row, $item['nik']);
            $sheet->setCellValue('C' . $row, $item['nama']);
            $sheet->setCellValue('D' . $row, $item['alamat']);
            $sheet->setCellValue('E' . $row, $item['no_telp']);
            $sheet->setCellValue('F' . $row, $item['rt']);
            $sheet->setCellValue('G' . $row, $item['rw']);
            $sheet->setCellValue('H' . $row, $item['jenis_kelamin']);
            $sheet->setCellValue('I' . $row, $item['pengurus_nama'] . ' - ' . 'RT. ' . $item['lingkup_rt']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        // Output the file directly to the browser
        $filename = 'Warga_Data_' . date('Y-m-d_H-i-s') . '.xlsx';

        // Set headers to prompt download
        $this->response->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $this->response->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
        $this->response->setHeader('Cache-Control', 'max-age=0');
        $this->response->setHeader('Cache-Control', 'max-age=1');
        $this->response->setHeader('Expires', 'Mon, 26 Jul 1997 05:00:00 GMT');
        $this->response->setHeader('Last-Modified', gmdate('D, d M Y H:i:s') . ' GMT');
        $this->response->setHeader('Pragma', 'public');

        // Output the file to the browser
        $response = $this->response;
        $response->setBody($writer->save('php://output'));
        return $response;
        exit();
    }
}
