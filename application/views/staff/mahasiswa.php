<!-- page content - HALAMAN UTAMA ISI DISINI -->
<div class="right_col" role="main">
	<h4 class="breadcrumb">Data Anggota</h4>
	<div class="card">
		<div class="card-body">
			<!-- Jika berhasil input data -->
			<?php if(isset($this->session->success)): ?>
			<div class="alert alert-primary alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fa fa-check"></i> Success!</h5>
				<?= $this->session->success ?>
			</div>
			<?php endif; ?>

			<!-- Jika gagal -->
			<?php if(isset($this->session->error)): ?>
			<div class="alert alert-primary alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<h5><i class="icon fa fa-exclamation-circle"></i> Alert!</h5>
				<?= $this->session->error ?>
			</div>
			<?php endif; ?>

			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#modal_add">
				<i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah data
			</button>

			<!-- Modal -->
			<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
				aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah data keanggotaan perpustakaan</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="<?= base_url('mahasiswa/create/staff') ?>" method="post">
							<div class="modal-body">
								<div class="form-group">
									<label for="nim">NIM</label>
									<input type="text" name="nim" id="nim" class="form-control" placeholder="NIM"
										aria-describedby="helpNIM" required maxlength="16">
									<small id="helpNIM" class="text-muted">NIM Harus bersifat unique.</small>
								</div>

								<div class="form-group">
									<label for="nama">Nama</label>
									<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required>
								</div>

								<div class="form-group">
									<label for="prodi">Program Studi</label>
									<select class="form-control select2" name="prodi" id="prodi">
										<option value="Teknik Elektro">Teknik Elektro</option>
										<option value="Teknik Informatika">Teknik Informatika</option>
										<option value="Teknik Perkapalan">Teknik Perkapalan</option>
										<option value="Akuntansi">Akuntansi</option>
										<option value="Manajemen">Manajemen</option>
										<option value="Ilmu Kelautan">Ilmu Kelautan</option>
										<option value="Manajemen Sumberdaya Kelautan">Manajemen Sumberdaya Kelautan
										</option>
										<option value="Budidaya Perairan">Budidaya Perairan</option>
										<option value="Teknologi Hasil Perikanan">Teknologi Hasil Perikanan</option>
										<option value="Sosial Ekonomi Perikanan">Sosial Ekonomi Perikanan</option>
										<option value="Pendidikan Bahasa dan Sastra Indonesia">Pendidikan Bahasa dan
											Sastra Indonesia</option>
										<option value="Pendidikan Biologi">Pendidikan Biologi</option>
										<option value="Pendidikan Kimia">Pendidikan Kimia</option>
										<option value="Pendidikan Matematika">Pendidikan Matematika</option>
										<option value="Ilmu Pemerintahan">Ilmu Pemerintahan</option>
										<option value="Ilmu Administrasi Negara">Ilmu Administrasi Negara</option>
										<option value="Sosiologi">Sosiologi</option>
										<option value="Ilmu Hukum">Ilmu Hukum</option>
										<option value="Hubungan Internasional">Hubungan Internasional</option>

									</select>
								</div>

								<div class="form-group">
									<label for="angkatan">Angkatan</label>
									<select class="form-control select2" name="angkatan" id="angkatan">
										<?php
										$tahun_ini = date('Y');
										$tahun_berdiri = 2007;
										while($tahun_ini >= $tahun_berdiri):
									?>
										<option value="<?= $tahun_ini ?>"><?= $tahun_ini ?></option>
										<?php 
										$tahun_ini--;
										endwhile ?>
									</select>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<table class="table table-striped table-bordered dataTable" style="width:100%">
				<thead>
					<tr>
						<th>No</th>
						<th>NIM</th>
						<th>Nama</th>
						<th>Prodi</th>
						<th>Angkatan</th>
						<th>Status</th>
						<th>Created at</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
                        $no = 1;
						
						foreach($mahasiswa as $row):
                    ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $row->nim  ?></td>
						<td><?= $row->nama ?></td>
						<td><?= $row->prodi ?></td>
						<td><?= $row->angkatan ?></td>
						<td>
							<?php 
								if($row->status == 'nonaktif'):
							?>
							<span class="badge badge-pill badge-warning">Nonaktif</span>
							<?php else: ?>
							<span class="badge badge-pill badge-success">Aktif</span>

							<?php endif; ?>
						</td>
						<td><?= date('d M Y (H:i)', strtotime($row->created_at)) ?></td>
						<td>
							<div class="btn-group" role="group" aria-label="">
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-warning" data-toggle="modal"
									data-target="#modelEdit_<?= $row->id ?>">
									<i class="fa fa-edit" aria-hidden="true"></i> Edit
								</button>
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-danger" data-toggle="modal"
									data-target="#modelDelete_<?= $row->id ?>">
									<i class="fa fa-trash" aria-hidden="true"></i> Delete
								</button>
							</div>
						</td>
					</tr>

					<!-- Modal Edit -->
					<div class="modal fade" id="modelEdit_<?= $row->id ?>" tabindex="-1" role="dialog"
						aria-labelledby="modelTitleId" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title"><i class="fa fa-question-circle-o" aria-hidden="true"></i>
										Edit Data Mahasiswa</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="<?= base_url('mahasiswa/update/staff') ?>" method="post">
									<div class="modal-body">
										<input type="hidden" name="id" value="<?= $row->id ?>">
										<div class="form-group">
											<label for="nim">NIM</label>
											<input type="text" name="nim" class="form-control"
												placeholder="NIM" aria-describedby="helpNIM" required maxlength="16" value="<?= $row->nim ?>">
											<small id="helpNIM" class="text-muted">NIM Harus bersifat unique.</small>
										</div>

										<div class="form-group">
											<label for="nama">Nama</label>
											<input type="text" name="nama" class="form-control"
												placeholder="Nama" required maxlength="16" value="<?= $row->nama ?>">
										</div>

										<div class="form-group">
											<label for="prodi">Program Studi</label>
											<select class="form-control select2" name="prodi">
											<?php
												$arr_prodi = [
													'Teknik Elektro',
													'Teknik Informatika',
													'Teknik Perkapalan',
													'Akuntansi',
													'Manajemen',
													'Ilmu Kelautan',
													'Manajemen Sumberdaya Kelautan',
													'Budidaya Perairan',
													'Teknologi Hasil Perikanan',
													'Sosial Ekonomi Perikanan',
													'Pendidikan Bahasa dan Sastra Indonesia',
													'Pendidikan Biologi',
													'Pendidikan Kimia',
													'Pendidikan Matematika',
													'Ilmu Pemerintahan',
													'Ilmu Administrasi Negara',
													'Sosiologi',
													'Ilmu Hukum',
													'Hubungan Internasional',
												];	
											
												foreach($arr_prodi as $prodi):
							
											?>					
											
											<option value="<?= $prodi ?>" <?= $row->prodi == $prodi ? 'selected' : null ?>><?= $prodi ?></option>
												
											<?php endforeach ?>
											</select>
										</div>

										<div class="form-group">
											<label for="angkatan">Angkatan</label>
											<select class="form-control select2" name="angkatan">
												<?php
										$tahun_ini = date('Y');
										$tahun_berdiri = 2007;
										while($tahun_ini >= $tahun_berdiri):
									?>
												<option value="<?= $tahun_ini ?>" <?= $tahun_ini == $row->angkatan ? 'selected' : null ?>><?= $tahun_ini ?></option>
												<?php 
										$tahun_ini--;
										endwhile ?>
											</select>
										</div>

										<div class="form-group">
											<label for="status">Status</label>
											<select class="form-control select2" name="status">
												<option value="aktif">Aktif</option>
												<option value="nonaktif">Nonaktif</option>
											</select>
										</div>

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary"
											data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<!-- Modal Delete -->
					<div class="modal fade" id="modelDelete_<?= $row->id ?>" tabindex="-1" role="dialog"
						aria-labelledby="modelTitleId" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title text-danger"><i class="fa fa-question-circle-o"
											aria-hidden="true"></i>
										Konfirmasi Hapus Data</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="<?= base_url('mahasiswa/delete/staff') ?>" method="post">
									<div class="modal-body">
										<input type="hidden" name="id" value="<?= $row->id ?>">
										Apakah anda ingin menghapus data keanggotaan '<span
											class="text-danger"><?= $row->nama ?></span>' ?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary"
											data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-danger">Hapus</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<?php
						endforeach;
                    ?>
				</tbody>
				<tfoot>
					<tr>
						<th>No</th>
						<th>Mahasiswa</th>
						<th>UID Kartu</th>
						<th>Loker</th>
						<th>Status</th>
						<th>IN</th>
						<th>OUT</th>
						<th>Actions</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<!-- /page content -->
