<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Admin extends CI_Controller {

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

        // Sql 5 Peminjam teraktif bulan ini
        $sql_peminjam_aktif = "SELECT p.id, p.nim, m.nama , count(p.nim) AS jml FROM peminjaman p
        INNER JOIN mahasiswa m ON p.nim = m.nim
        WHERE p.created_at LIKE '". date('Y-m') ."%' GROUP BY p.nim ORDER BY jml DESC LIMIT 5";

        // Sql Footer
        $sql_jan = "SELECT count(*) AS jml from peminjaman where created_at like '". date('Y-') ."01%'";
        $sql_feb = "SELECT count(*) AS jml from peminjaman where created_at like '". date('Y-') ."02%'";
        $sql_mar = "SELECT count(*) AS jml from peminjaman where created_at like '". date('Y-') ."03%'";
        $sql_apr = "SELECT count(*) AS jml from peminjaman where created_at like '". date('Y-') ."04%'";
        $sql_may = "SELECT count(*) AS jml from peminjaman where created_at like '". date('Y-') ."05%'";
        $sql_jun = "SELECT count(*) AS jml from peminjaman where created_at like '". date('Y-') ."06%'";
        $sql_jul = "SELECT count(*) AS jml from peminjaman where created_at like '". date('Y-') ."07%'";
        $sql_aug = "SELECT count(*) AS jml from peminjaman where created_at like '". date('Y-') ."08%'";
        $sql_sep = "SELECT count(*) AS jml from peminjaman where created_at like '". date('Y-') ."09%'";
        $sql_oct = "SELECT count(*) AS jml from peminjaman where created_at like '". date('Y-') ."10%'";
        $sql_nov = "SELECT count(*) AS jml from peminjaman where created_at like '". date('Y-') ."11%'";
        $sql_dec = "SELECT count(*) AS jml from peminjaman where created_at like '". date('Y-') ."12%'";


        // Page data
        $data = [
            'loker' => $this->sql->select_table('loker')->result(),
            'peminjaman' => $this->sql->manual_query($sql_peminjaman)->result(),
            'peminjam' => $this->sql->manual_query($sql_peminjam_aktif)->result(),
            'realtime' => true
        ];

        // Footer data
        $footer_data = [
            'jan' => $this->sql->manual_query($sql_jan)->result(),
            'feb' => $this->sql->manual_query($sql_feb)->result(),
            'mar' => $this->sql->manual_query($sql_mar)->result(),
            'apr' => $this->sql->manual_query($sql_apr)->result(),
            'may' => $this->sql->manual_query($sql_may)->result(),
            'jun' => $this->sql->manual_query($sql_jun)->result(),
            'jul' => $this->sql->manual_query($sql_jul)->result(),
            'aug' => $this->sql->manual_query($sql_aug)->result(),
            'sep' => $this->sql->manual_query($sql_sep)->result(),
            'oct' => $this->sql->manual_query($sql_oct)->result(),
            'nov' => $this->sql->manual_query($sql_nov)->result(),
            'dec' => $this->sql->manual_query($sql_dec)->result(),
        ];

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar', [
            'active' => 'home'
        ]);
        $this->load->view('admin/template/nav');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/template/footer_dashboard', $footer_data);
    }

    // Halaman Profile
    public function profile()
    {
        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar', [
            'active' => 'profile'
        ]);
        $this->load->view('admin/template/nav');
        $this->load->view('admin/profile');
        $this->load->view('admin/template/footer');
    }

    // Halaman Mahasiswa
    public function mahasiswa()
    {
        // Page data
        $data = [
            'mahasiswa' => $this->sql->select_table('mahasiswa', null, 'id', 'desc')->result()
        ];

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar', [
            'active' => 'mahasiswa'
        ]);
        $this->load->view('admin/template/nav');
        $this->load->view('admin/mahasiswa', $data);
        $this->load->view('admin/template/footer');
    }

    // Halaman Loker
    public function loker()
    {
        // Page data
        $data = [
            'loker' => $this->sql->select_table('loker', null, 'kode_loker')->result()
        ];

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar', [
            'active' => 'loker'
        ]);
        $this->load->view('admin/template/nav');
        $this->load->view('admin/loker', $data);
        $this->load->view('admin/template/footer');
    }

    // Halaman Kartu
    public function kartu()
    {
        // Page data
        $data = [
            'kartu' => $this->sql->select_table('kartu', null, 'id', 'desc')->result(),
            'loker' => $this->sql->select_table('loker', null, 'kode_loker')->result()
        ];

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar', [
            'active' => 'kartu'
        ]);
        $this->load->view('admin/template/nav');
        $this->load->view('admin/kartu', $data);
        $this->load->view('admin/template/footer');
    }

    // Halaman akun
    public function akun()
    {
        // Page data
        $data = [
            'akun' => $this->sql->select_table('users', [
                'username !=' => $this->session->username
            ], 'nama')->result(),
        ];

        $this->load->view('admin/template/header');
        $this->load->view('admin/template/sidebar', [
            'active' => 'kartu'
        ]);
        $this->load->view('admin/template/nav');
        $this->load->view('admin/akun', $data);
        $this->load->view('admin/template/footer');
    }

    // Middleware
    public function middleware()
    {
        if(!isset($this->session->role)){
            redirect(base_url());
        }else{
            if($this->session->role == 'staff'){
                redirect(base_url('staff'));
            }
        }
    }
}

/* End of file Admin.php and path \application\controllers\Admin.php */
