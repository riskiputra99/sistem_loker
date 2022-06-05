<!-- page content - HALAMAN UTAMA ISI DISINI -->
<div class="right_col" role="main">
	<h4 class="breadcrumb">Data Loker</h4>
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
							<h5 class="modal-title">Tambah data loker</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="<?= base_url('loker/create') ?>" method="post">
							<div class="modal-body">
								<div class="form-group">
									<label for="KodeLoker">Kode Loker</label>
									<input type="text" name="kode_loker" id="KodeLoker" class="form-control" placeholder="Kode Loker..."
										aria-describedby="helpKodeLoker" required maxlength="3">
									<small id="helpKodeLoker" class="text-muted">Kode Loker Harus bersifat unique.</small>
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
						<th>Kode Loker</th>
						<th>Status</th>
						<th>Terakhir dipakai</th>
						<th>Created at</th>
						<th>Updated at</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
                        $no = 1;
						
						foreach($loker as $row):
                    ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $row->kode_loker  ?></td>
						<td>
							<?php 
								if($row->status !== 'kosong'):
							?>
							<span class="badge badge-pill badge-warning">Sedang digunakan</span>
							<?php else: ?>
							<span class="badge badge-pill badge-success">Kosong</span>

							<?php endif; ?>
						</td>
						<td><?= $row->last_borrowed == null ? '-' : date('d M Y (H:i)', strtotime($row->last_borrowed))  ?></td>
						<td><?= date('d M Y (H:i)', strtotime($row->created_at)) ?></td>
						<td><?= $row->updated_at == null ? '-' : date('d M Y (H:i)', strtotime($row->updated_at))  ?></td>
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
										Edit Data loker</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="<?= base_url('loker/update') ?>" method="post">
									<div class="modal-body">
										<input type="hidden" name="id" value="<?= $row->id ?>">
										<div class="form-group">
											<label for="KodeLoker">Kode Loker</label>
											<input type="text" name="kode_loker" id="KodeLoker" class="form-control" placeholder="Kode Loker..."
												aria-describedby="helpKodeLoker" required maxlength="3" value="<?= $row->kode_loker ?>">
											<small id="helpKodeLoker" class="text-muted">Kode Loker Harus bersifat unique.</small>
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
								<form action="<?= base_url('loker/delete') ?>" method="post">
									<div class="modal-body">
										<input type="hidden" name="id" value="<?= $row->id ?>">
										Apakah anda ingin menghapus data loker '<span
											class="text-danger"><?= $row->kode_loker ?></span>' ?
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
						<th>Kode Loker</th>
						<th>Status</th>
						<th>Terakhir dipakai</th>
						<th>Created at</th>
						<th>Updated at</th>
						<th>Actions</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<!-- /page content -->
