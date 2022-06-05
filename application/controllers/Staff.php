<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware();
    }

    // Index
    public function index()
    {
        // Sql
        $sql_peminjaman = "SELECT p.id, m.nim, m.nama, p.kartu, p.loker, p.status, p.in, p.out, p.created_at from peminjaman p 
        INNER JOIN mahasiswa m ON p.nim = m.nim
        ORDER BY p.created_at desc limit 5";

        // Page data
        $data = [
            'loker' => $this->sql->select_table('loker')->result(),
            'peminjaman' => $this->sql->manual_query($sql_peminjaman)->result(),
            'realtime' => true
        ];

        $this->load->view('staff/template/header');
        $this->load->view('staff/template/sidebar', [
            'active' => 'home'
        ]);
        $this->load->view('staff/template/nav');
        $this->load->view('staff/dashboard', $data);
        $this->load->view('staff/template/footer');
    }

    // Halaman Peminjaman
    public function peminjaman()
    {
        // Sql peminjaman
        $sql_peminjaman = "SELECT p.id, m.nim, m.nama, p.kartu, p.loker, p.status, p.in, p.out, p.created_at from peminjaman p 
        INNER JOIN mahasiswa m ON p.nim = m.nim
        WHERE p.status = 'dipakai'
        ORDER BY p.created_at desc";

        // Sql loker kosong
        $sql_loker = "SELECT k.* FROM kartu k
        INNER JOIN loker l ON k.loker_id = l.kode_loker
        WHERE l.status = 'kosong'
        ORDER BY l.kode_loker";

        // Page data
        $data = [
            'peminjaman' => $this->sql->manual_query($sql_peminjaman)->result(),
            'loker' => $this->sql->manual_query($sql_loker)->result(),
            'mahasiswa' => $this->sql->select_table('mahasiswa', [
                'status' => 'aktif'
            ])->result()
        ];

        $this->load->view('staff/template/header');
        $this->load->view('staff/template/sidebar', [
            'active' => 'peminjaman'
        ]);
        $this->load->view('staff/template/nav');
        $this->load->view('staff/peminjaman', $data);
        $this->load->view('staff/template/footer');
    }

    // Halaman Mahasiswa
    public function mahasiswa()
    {
        // Page data
        $data = [
            'mahasiswa' => $this->sql->select_table('mahasiswa', null, 'id', 'desc')->result()
        ];

        $this->load->view('staff/template/header');
        $this->load->view('staff/template/sidebar', [
            'active' => 'mahasiswa'
        ]);
        $this->load->view('staff/template/nav');
        $this->load->view('staff/mahasiswa', $data);
        $this->load->view('staff/template/footer');
    }

    // Halaman Riwayat Peminjaman
    public function riwayat()
    {
        // Sql peminjaman
        $sql_peminjaman = "SELECT p.id, m.nim, m.nama, p.kartu, p.loker, p.status, p.in, p.out, p.created_at from peminjaman p 
        INNER JOIN mahasiswa m ON p.nim = m.nim
        ORDER BY p.created_at desc";

        // Page data
        $data = [
            'peminjaman' => $this->sql->manual_query($sql_peminjaman)->result(),
        ];

        $this->load->view('staff/template/header');
        $this->load->view('staff/template/sidebar', [
            'active' => 'peminjaman'
        ]);
        $this->load->view('staff/template/nav');
        $this->load->view('staff/riwayat', $data);
        $this->load->view('staff/template/footer');
    }

    // Halaman Profile
    public function profile()
    {
        $this->load->view('staff/template/header');
        $this->load->view('staff/template/sidebar', [
            'active' => 'profile'
        ]);
        $this->load->view('staff/template/nav');
        $this->load->view('staff/profile');
        $this->load->view('staff/template/footer');
    }

    // Middleware
    public function middleware()
    {
        if (!isset($this->session->role)) {
            redirect(base_url());
        } else {
            if ($this->session->role == 'admin') {
                redirect(base_url('admin'));
            }
        }
    }
}

/* End of file Staff.php and path \application\controllers\Staff.php */
