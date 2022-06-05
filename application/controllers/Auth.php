<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    // Halaman Login
    public function index()
    {
        $this->load->view('login');           
    }

    // Not Found Page
    public function not_found()
    {
        $this->load->view('not_found');
    }

    // Process Login
    public function login()
    {
		if ($this->input->post()) {
			$post = $this->input->post();
			$query = $this->sql->select_table('users', array('username' => $post['username']));
			if ($query->num_rows() > 0) {
				$get = $query->row_array();
				if (password_verify($post['password'], $get['password'])) {
					$data = [
						'username' => $get['username'],
                        'nama' => $get['nama'],
						'photo' => $get['photo'],
						'role' => $get['role']
					];

                    // Set session
					$this->session->set_userdata($data);

                    // Redirect berdasarkan role
                    if($get['role'] == 'admin'){
                        redirect('admin');
                    }else{
                        redirect('staff');
                    }
				} else {
					$this->session->set_flashdata('error', "Password salah");
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('error', "Username atau password salah");
				redirect('auth');
			}
		} else {
			redirect('auth');
		}
	}

    // Fungsi Logout
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("auth");
	}

	// Fungsi ganti profile
	public function update_profile($role)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			$data = [
				'nama' => $post['nama'],
			];

			// Generate random string 16 digit
            $unique = random_string('alnum', 16);

            // Konfigurasi Upload Image
            $config['upload_path']          = './assets/images/profile/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG|JPEG';
            $config['file_name']            = $unique . '-' . date('dmY');
            $config['overwrite']            = true;
            $config['max_size']             = 1024 * 8; // 8MB

            // Load library upload
            $this->load->library('upload', $config);

			// Jika berhasil upload gambar
			if($this->upload->do_upload('photo')){
				// ambil data profil saat ini
				$current_photo = $this->session->photo;

				// Jika data photo sebelumnya bukan file default.jpg
				if($current_photo != 'default.png'){
					// Hapus file dari folder profile
					unlink('./assets/images/profile/'. $current_photo);
				}

				$data['photo'] = $this->upload->data('file_name');
				$this->session->set_userdata([
					'photo' => $data['photo']
				]);
			}

			$this->session->set_userdata([
				'nama' => $data['nama']
			]);

			$update = $this->sql->update_table('users', $data, ['username' => $post['username']]);
			if($update){
				$this->session->set_flashdata('success', 'Profile berhasil diperbarui');
				$this->session->set_flashdata('tab_active', 'profile');
				redirect(base_url($role . '/profile'));
			}else{
				$this->session->set_flashdata('danger', 'Profile gagal diperbarui');
				$this->session->set_flashdata('tab_active', 'profile');
				redirect(base_url($role . '/profile'));
			}

		}else{
			redirect(base_url($role . '/profile'));
		}
	}

	// Fungsi Ganti Password
	public function change_password($role)
	{
		if ($this->input->post()) {
			$post = $this->input->post();
			
			if($post['password_baru'] !== $post['password_konfirmasi']){
				$this->session->set_flashdata('error', 'Password baru dan konfirmasi password baru tidak cocok.');
				$this->session->set_flashdata('tab_active', 'password');
				redirect(base_url($role . '/profile'));
			}else{
				$query = $this->sql->select_table('users', [
					'username' => $post['username']
				]);
				if ($query->num_rows() > 0) {
					$get = $query->row_array();
					if (password_verify($post['password_lama'], $get['password'])) {
						$new_password = password_hash($post['password_baru'], PASSWORD_DEFAULT);

						$this->sql->update_table('users', [
							'password' => $new_password
						], [
							'username' => $post['username']
						]);

						$this->session->set_flashdata('success', 'Password berhasil diperbarui');
						redirect(base_url($role . '/profile'));
					}else{
						$this->session->set_flashdata('error', 'Password salah.');
						$this->session->set_flashdata('tab_active', 'password');
						redirect(base_url($role . '/profile'));
					}
				}else{
					$this->session->set_flashdata('error', 'Invalid User data');
					$this->session->set_flashdata('tab_active', 'password');
					redirect(base_url($role . '/profile'));
				}
			}
		}else{
			redirect(base_url($role . '/profile'));
		}
	}
}

/* End of file Auth.php and path \application\controllers\Auth.php */
