<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Mahasiswa extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    // Tambah mahasiswa
    public function create($role)
    {
        // ambil data form
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $prodi = $this->input->post('prodi');
        $angkatan = $this->input->post('angkatan');


        // Data anggota baru
        $new_data = [
            'nim' => $nim,
            'nama' => $nama,
            'prodi' => $prodi,
            'angkatan' => $angkatan,
        ];
        
        // Cek apakah NIM telah terdaftar
        $check = $this->sql->select_table('mahasiswa', [
            'nim' => $nim,
        ]);

        // Jika NIM telah terdaftar
        if ($check->num_rows() > 0) {
            $this->session->set_flashdata('error', "NIM $nim telah terdaftar! ");
            redirect(base_url($role . '/mahasiswa'));
        }else{
            // Simpan anggota baru ke database
            $new_id = $this->sql->insert_table('mahasiswa', $new_data);

            // Check jika status loker berhasil diperbarui
            if($new_id){
                $this->session->set_flashdata('success', 'Data Anggota telah berhasil disimpan! ');
                redirect(base_url($role . '/mahasiswa'));
            }else{
                $this->session->set_flashdata('error', 'Data Anggota gagal disimpan! ');
                redirect(base_url($role . '/mahasiswa'));
            }
        }
    }

    // Edit data Mahasiswa
    public function update($role)
    {
        // ambil data form
        $id = $this->input->post('id');
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $prodi = $this->input->post('prodi');
        $angkatan = $this->input->post('angkatan');
        $status = $this->input->post('status');

        // Data anggota baru
        $new_data = [
            'nim' => $nim,
            'nama' => $nama,
            'prodi' => $prodi,
            'angkatan' => $angkatan,
            'status' => $status,
        ];
        
        // Simpan anggota baru ke database
        $new_id = $this->sql->update_table('mahasiswa', $new_data, [
            'id' => $id
        ]);

        // Check jika status loker berhasil diperbarui
        if($new_id){
            $this->session->set_flashdata('success', 'Data Anggota telah berhasil diperbarui! ');
            redirect(base_url($role . '/mahasiswa'));
        }else{
            $this->session->set_flashdata('error', 'Data Anggota gagal diperbarui! ');
            redirect(base_url($role . '/mahasiswa'));
        }
    }

    // Delete data Mahasiswa
    public function delete($role)
    {
        if($this->input->post()){
            $id = $this->input->post('id');
            $where = ['id' => $id];
            
            // Hapus data
            $delete = $this->sql->delete_table('mahasiswa', $where);
        
            // Check jika data deleted
            if($delete){
                $this->session->set_flashdata('success', 'Data Anggota telah berhasil dihapus! ');
                redirect(base_url($role . '/mahasiswa'));
            }else{
                $this->session->set_flashdata('error', 'Data Anggota gagal dihapus! ');
                redirect(base_url($role . '/mahasiswa'));
            }
        }else{
        }
    }
}

/* End of file Mahasiswa.php and path \application\controllers\Mahasiswa.php */
