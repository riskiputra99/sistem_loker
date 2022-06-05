<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Loker extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    // Tambah data Loker
    public function create()
    {
        // ambil data form
        $kode_loker = $this->input->post('kode_loker');


        // Data loker baru
        $new_data = [
            'kode_loker' => $kode_loker,
        ];
        
        // Cek apakah kode_loker telah terdaftar
        $check = $this->sql->select_table('loker', [
            'kode_loker' => $kode_loker,
        ]);

        // Jika NIM telah terdaftar
        if ($check->num_rows() > 0) {
            $this->session->set_flashdata('error', "Kode $kode_loker telah terdaftar! ");
            redirect(base_url('admin/loker'));
        }else{
            // Simpan loker baru ke database
            $new_id = $this->sql->insert_table('loker', $new_data);

            // Check jika status loker berhasil diperbarui
            if($new_id){
                $this->session->set_flashdata('success', 'Data loker telah berhasil disimpan! ');
                redirect(base_url('admin/loker'));
            }else{
                $this->session->set_flashdata('error', 'Data loker gagal disimpan! ');
                redirect(base_url('admin/loker'));
            }
        }
    }

    // Update Loker
    public function update()
    {
        // ambil data form
        $id = $this->input->post('id');
        $kode_loker = $this->input->post('kode_loker');
        $updated_at = date("Y-m-d H:i:s");

        // Data loker baru
        $new_data = [
            'kode_loker' => $kode_loker,
            'updated_at' => $updated_at,
        ];
        
        // Simpan loker baru ke database
        $updated = $this->sql->update_table('loker', $new_data, [
            'id' => $id
        ]);

        // Check jika status loker berhasil diperbarui
        if($updated){
            $this->session->set_flashdata('success', 'Data loker telah berhasil diperbarui! ');
            redirect(base_url('admin/loker'));
        }else{
            $this->session->set_flashdata('error', 'Data loker gagal diperbarui! ');
            redirect(base_url('admin/loker'));
        }
    }

    // Hapus Loker
    public function delete()
    {
        if($this->input->post()){
            $id = $this->input->post('id');
            $where = ['id' => $id];
            
            // Hapus data
            $delete = $this->sql->delete_table('loker', $where);
        
            // Check jika data deleted
            if($delete){
                $this->session->set_flashdata('success', 'Data loker telah berhasil dihapus! ');
                redirect(base_url('admin/loker'));
            }else{
                $this->session->set_flashdata('error', 'Data loker gagal dihapus! ');
                redirect(base_url('admin/loker'));
            }
        }else{
        }
    }
}

/* End of file Loker.php and path \application\controllers\Loker.php */
