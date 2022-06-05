<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function update_data_loker()
    {
        $status_loker = $this->input->get('statusloker');
        $kode_loker = $this->input->get('kodeloker');

        $data = [];
        if ($status_loker) {
            $data = [
                'status' => 'dipakai'
            ];
        } else {
            $data = [
                'status' => 'kosong'
            ];
        }

        $this->db->update('loker', $data, ['kode_loker' => $kode_loker]);
        $response = [
            'success' => true,
        ];
        echo json_encode($response);
        die;
    }

    public function get_data_loker()
    {
        $kode_loker = $this->input->get('kodeloker');

        $this->db->select('*');
        $this->db->from('peminjaman');
        $this->db->where('loker', $kode_loker);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        $status = "";
        if ($query->num_rows() > 0) {
            $data = $query->result()[0];
            $status = $data->status;
        } else {
            $status = "-";
        }

        $response = [
            'success' => true,
            'status' => $status
        ];
        echo json_encode($response);
        die;
    }

    public function update_data_berat()
    {
        $berat = $this->input->get('berat');
        $kode_loker = $this->input->get('kodeloker');

        $data = [];
        if ($berat) {
            $data = [
                'berat' => 1
            ];
        } else {
            $data = [
                'berat' => 0
            ];
        }

        $this->db->update('loker', $data, ['kode_loker' => $kode_loker]);
        $response = [
            'success' => true,
        ];
        echo json_encode($response);
        die;
    }


    public function realtime()
    {
        $loker = $this->sql->select_table('loker')->result();

        foreach ($loker as $lok) :
            if ($lok->status == 'kosong' && $lok->berat == 1) {
                echo '
				<div class="col-lg-4 col-md-6 col-sm-6 col-6">
					<div class="card mb-4">
						<div class="card-header">
							<h5 class="card-title">
								Loker ' . $lok->kode_loker . '
							</h5>
						</div>
						<div class="card-body" style="background-color: green; height: 50px">
							<h6 class="text-center text-white">Kosong</h6>
						</div>
                        <div class="card-body" style="background-color: yellow; height: 50px">
							<h6 class="text-center text-danger">Ada Barang</h6>
						</div>
					</div>
				</div>';
            }

            if ($lok->status == 'kosong' && $lok->berat == 0) {
                echo '
                <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">
                                Loker ' . $lok->kode_loker . '
                            </h5>
                        </div>
                        <div class="card-body" style="background-color: green; height: 50px">
                            <h6 class="text-center text-white">Kosong</h6>
                        </div>
                        <div class="card-body" style="background-color: blue; height: 50px">
							<h6 class="text-center text-white">Tidak Ada Barang</h6>
						</div>
                    </div>
                </div>';
            }

            if ($lok->status == 'dipakai' && $lok->berat == 1) {
                echo '
				<div class="col-lg-4 col-md-6 col-sm-6 col-6">
					<div class="card mb-4">
						<div class="card-header">
							<h5 class="card-title">
								Loker ' . $lok->kode_loker . '
							</h5>
						</div>
						<div class="card-body" style="background-color:crimson; height: 50px">
							<h6 class="text-center text-white">Dipakai</h6>
						</div>
                        <div class="card-body" style="background-color: yellow; height: 50px">
							<h6 class="text-center text-danger">Ada Barang</h6>
						</div>
					</div>
				</div>';
            }

            if ($lok->status == 'dipakai' && $lok->berat == 0) {
                echo '
                <div class="col-lg-4 col-md-6 col-sm-6 col-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">
                                Loker ' . $lok->kode_loker . '
                            </h5>
                        </div>
                        <div class="card-body" style="background-color:crimson; height: 50px">
                            <h6 class="text-center text-white">Dipakai</h6>
                        </div>
                        <div class="card-body" style="background-color: blue; height: 50px">
							<h6 class="text-center text-white">Tidak Ada Barang</h6>
						</div>
                    </div>
                </div>';
            }
        endforeach;
    }
}
