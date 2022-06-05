<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
        
class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    
    // Tambah data akun
    public function create()
    {
        // ambil data form
        $username = $this->input->post('username');
        $nama = $this->input->post('nama');
        $role = $this->input->post('role');
        $password_default = 'password123';
        $password = password_hash($password_default, PASSWORD_DEFAULT);

        // Data akun baru
        $new_data = [
            'username' => $username,
            'nama' => $nama,
            'role' => $role,
            'password' => $password
        ];
        
        // Cek apakah username telah terdaftar
        $check = $this->sql->select_table('users', [
            'username' => $username,
        ]);

        // Jika NIM telah terdaftar
        if ($check->num_rows() > 0) {
            $this->session->set_flashdata('error', "Username $username telah terdaftar! ");
            redirect(base_url('admin/akun'));
        }else{
            // Simpan akun baru ke database
            $new_id = $this->sql->insert_table('users', $new_data);

            // Check jika status akun berhasil diperbarui
            if($new_id){
                $this->session->set_flashdata('success', 'Data akun telah berhasil disimpan! ');
                redirect(base_url('admin/akun'));
            }else{
                $this->session->set_flashdata('error', 'Data akun gagal disimpan! ');
                redirect(base_url('admin/akun'));
            }
        }
    }

    // Update akun
    public function update()
    {
        // ambil data form
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $nama = $this->input->post('nama');
        $role = $this->input->post('role');
        $updated_at = date("Y-m-d H:i:s");

        // Data akun baru
        $new_data = [
            'username' => $username,
            'nama' => $nama,
            'role' => $role,
            'updated_at' => $updated_at,
        ];
        
        // Simpan akun baru ke database
        $updated = $this->sql->update_table('users', $new_data, [
            'id' => $id
        ]);

        // Check jika status akun berhasil diperbarui
        if($updated){
            $this->session->set_flashdata('success', 'Data akun telah berhasil diperbarui! ');
            redirect(base_url('admin/akun'));
        }else{
            $this->session->set_flashdata('error', 'Data akun gagal diperbarui! ');
            redirect(base_url('admin/akun'));
        }
    }

    // Hapus akun
    public function delete()
    {
        if($this->input->post()){
            $id = $this->input->post('id');
            $where = ['id' => $id];
            
            // Hapus data
            $delete = $this->sql->delete_table('users', $where);
        
            // Check jika data deleted
            if($delete){
                $this->session->set_flashdata('success', 'Data akun telah berhasil dihapus! ');
                redirect(base_url('admin/akun'));
            }else{
                $this->session->set_flashdata('error', 'Data akun gagal dihapus! ');
                redirect(base_url('admin/akun'));
            }
        }else{
        }
    }
}

/* End of file User.php and path \application\controllers\User.php */
