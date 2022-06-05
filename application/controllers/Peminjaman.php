<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    // Tambah peminjam
    public function create()
    {
        // ambil data form
        $nim = $this->input->post('nim');
        $kartu = explode('_', $this->input->post('kartu'))[0];
        $loker = explode('_', $this->input->post('kartu'))[1];

        // Data peminjaman baru
        $new_data = [
            'nim' => $nim,
            'kartu' => $kartu,
            'loker' => $loker,
        ];

        // Simpan Peminjaman baru ke database
        $new_id = $this->sql->insert_table('peminjaman', $new_data);

        // Update status loker
        $update_loker = $this->sql->update_table('loker', [
            'status' => 'dipakai',
            'last_borrowed' => date('Y-m-d H:i:s')
        ], [
            'kode_loker' => $loker
        ]);

        // Check jika status loker berhasil diperbarui
        if ($update_loker) {
            $this->session->set_flashdata('success', 'Data Peminjaman telah berhasil disimpan! ');
            redirect(base_url('staff/peminjaman'));
        } else {
            $this->session->set_flashdata('error', 'Data Peminjaman gagal disimpan! ');
            redirect(base_url('staff/peminjaman'));
        }
    }

    // Pengembalian
    public function return()
    {
        // ambil data form
        $id = $this->input->post('id');

        // fetch detail peminjaman
        $data = $this->sql->select_table('peminjaman', [
            'id' => $id
        ])->row();


        // Update data peminjaman
        $update_peminjaman = $this->sql->update_table('peminjaman', [
            'status' => 'selesai',
            'out' => date('Y-m-d H:i:s')
        ], [
            'id' => $id
        ]);

        // // Update status loker
        $update_loker = $this->sql->update_table('loker', [
            'status' => 'kosong',
        ], [
            'kode_loker' => $data->loker
        ]);

        // Check jika status loker berhasil diperbarui
        if ($update_loker) {
            $this->session->set_flashdata('success', 'Data Pengembalian telah berhasil disimpan! ');
            redirect(base_url('staff/peminjaman'));
        } else {
            $this->session->set_flashdata('error', 'Data Pemgembalian gagal disimpan! ');
            redirect(base_url('staff/peminjaman'));
        }
    }
}

/* End of file Peminjaman.php and path \application\controllers\Peminjaman.php */
