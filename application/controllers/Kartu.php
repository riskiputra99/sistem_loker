<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Kartu extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    // Tambah data kartu
    public function create()
    {
        // ambil data form
        $kartu_uid = $this->input->post('kartu_uid');
        $type = $this->input->post('type');
        $loker_id = $this->input->post('loker_id');



        // Data kartu baru
        $new_data = [
            'kartu_uid' => $kartu_uid,
            'type' => $type,
            'loker_id' => $loker_id,
        ];
        
        // Cek apakah kartu_uid telah terdaftar
        $check = $this->sql->select_table('kartu', [
            'kartu_uid' => $kartu_uid,
        ]);

        // Jika NIM telah terdaftar
        if ($check->num_rows() > 0) {
            $this->session->set_flashdata('error', "Kartu $kartu_uid telah terdaftar! ");
            redirect(base_url('admin/kartu'));
        }else{
            // Simpan kartu baru ke database
            $new_id = $this->sql->insert_table('kartu', $new_data);

            // Check jika status kartu berhasil diperbarui
            if($new_id){
                $this->session->set_flashdata('success', 'Data kartu telah berhasil disimpan! ');
                redirect(base_url('admin/kartu'));
            }else{
                $this->session->set_flashdata('error', 'Data kartu gagal disimpan! ');
                redirect(base_url('admin/kartu'));
            }
        }
    }

    // Update kartu
    public function update()
    {
        // ambil data form
        $id = $this->input->post('id');
        $kartu_uid = $this->input->post('kartu_uid');
        $type = $this->input->post('type');
        $loker_id = $this->input->post('loker_id');
        $updated_at = date("Y-m-d H:i:s");

        // Data kartu baru
        $new_data = [
            'kartu_uid' => $kartu_uid,
            'type' => $type,
            'loker_id' => $loker_id,
            'updated_at' => $updated_at,
        ];
        
        // Simpan kartu baru ke database
        $updated = $this->sql->update_table('kartu', $new_data, [
            'id' => $id
        ]);

        // Check jika status kartu berhasil diperbarui
        if($updated){
            $this->session->set_flashdata('success', 'Data kartu telah berhasil diperbarui! ');
            redirect(base_url('admin/kartu'));
        }else{
            $this->session->set_flashdata('error', 'Data kartu gagal diperbarui! ');
            redirect(base_url('admin/kartu'));
        }
    }

    // Hapus kartu
    public function delete()
    {
        if($this->input->post()){
            $id = $this->input->post('id');
            $where = ['id' => $id];
            
            // Hapus data
            $delete = $this->sql->delete_table('kartu', $where);
        
            // Check jika data deleted
            if($delete){
                $this->session->set_flashdata('success', 'Data kartu telah berhasil dihapus! ');
                redirect(base_url('admin/kartu'));
            }else{
                $this->session->set_flashdata('error', 'Data kartu gagal dihapus! ');
                redirect(base_url('admin/kartu'));
            }
        }else{
        }
    }
}

/* End of file Kartu.php and path \application\controllers\Kartu.php */
