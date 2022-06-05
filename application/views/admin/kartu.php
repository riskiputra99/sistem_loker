<!-- page content - HALAMAN UTAMA ISI DISINI -->
<div class="right_col" role="main">
	<h4 class="breadcrumb">Data Kartu RFID</h4>
	<div class="card">
		<div class="card-body">
			<!-- Jika berhasil input data -->
			<?php if (isset($this->session->success)) : ?>
				<div class="alert alert-primary alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fa fa-check"></i> Success!</h5>
					<?= $this->session->success ?>
				</div>
			<?php endif; ?>

			<!-- Jika gagal -->
			<?php if (isset($this->session->error)) : ?>
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
			<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah data kartu loker RFID</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="<?= base_url('kartu/create') ?>" method="post">
							<div class="modal-body">
								<div class="form-group">
									<label for="kartu_uid">UID Kartu</label>
									<input type="text" name="kartu_uid" id="kartu_uid" class="form-control" placeholder="UID Kartu" aria-describedby="helpkartu_uid" required maxlength="8">
									<small id="helpkartu_uid" class="text-muted">UID Kartu Harus bersifat unique.</small>
								</div>

								<div class="form-group">
									<label for="type">Type Kartu</label>
									<select class="form-control select2" name="type" id="type">
										<option value="normal">Normal</option>
										<option value="mastercard">Mastercard</option>
									</select>
								</div>

								<div class="form-group">
									<label for="loker_id">Loker ID</label>
									<select class="form-control select2" name="loker_id" id="loker_id">
										<?php
										foreach ($loker as $lok) :
										?>
											<option value="<?= $lok->kode_loker ?>"><?= $lok->kode_loker ?></option>
										<?php
										endforeach
										?>
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
						<th>UID Kartu</th>
						<th>Type</th>
						<th>Loker</th>
						<th>Created at</th>
						<th>Updated at</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;

					foreach ($kartu as $row) :
					?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $row->kartu_uid  ?></td>
							<td>
								<?php
								if ($row->type == 'mastercard') :
								?>
									<span class="badge badge-pill badge-danger">Mastercard</span>
								<?php else : ?>
									<span class="badge badge-pill badge-success">Normalcard</span>
								<?php endif; ?>
							</td>
							<td><?= $row->loker_id  ?></td>
							<td><?= date('d M Y (H:i)', strtotime($row->created_at)) ?></td>
							<td><?= $row->updated_at == null ? '-' : date('d M Y (H:i)', strtotime($row->updated_at))  ?></td>
							<td>
								<div class="btn-group" role="group" aria-label="">
									<!-- Button trigger modal -->
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modelEdit_<?= $row->id ?>">
										<i class="fa fa-edit" aria-hidden="true"></i> Edit
									</button>
									<!-- Button trigger modal -->
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modelDelete_<?= $row->id ?>">
										<i class="fa fa-trash" aria-hidden="true"></i> Delete
									</button>
								</div>
							</td>
						</tr>

						<!-- Modal Edit -->
						<div class="modal fade" id="modelEdit_<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title"><i class="fa fa-question-circle-o" aria-hidden="true"></i>
											Edit Data kartu</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="<?= base_url('kartu/update') ?>" method="post">
										<div class="modal-body">
											<input type="hidden" name="id" value="<?= $row->id ?>">
											<div class="form-group">
												<label for="kartu_uid">kartu_uid</label>
												<input type="text" name="kartu_uid" class="form-control" placeholder="kartu_uid" aria-describedby="helpkartu_uid" required maxlength="8" value="<?= $row->kartu_uid ?>">
												<small id="helpkartu_uid" class="text-muted">kartu_uid Harus bersifat unique.</small>
											</div>

											<div class="form-group">
												<label for="type">Type Kartu</label>
												<select class="form-control select2" name="type" id="type">
													<option value="normal" <?= $row->type == 'normal' ? 'selected' : null ?>>Normal</option>
													<option value="mastercard" <?= $row->type == 'mastercard' ? 'selected' : null ?>>Mastercard</option>
												</select>
											</div>

											<div class="form-group">
												<label for="loker_id">Loker ID</label>
												<select class="form-control select2" name="loker_id" id="loker_id">
													<?php
													foreach ($loker as $lok) :
													?>
														<option value="<?= $lok->kode_loker ?>" <?= $row->loker_id == $lok->kode_loker ? "selected" : null ?>><?= $lok->kode_loker ?></option>
													<?php
													endforeach
													?>
												</select>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary">Update</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<!-- Modal Delete -->
						<div class="modal fade" id="modelDelete_<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title text-danger"><i class="fa fa-question-circle-o" aria-hidden="true"></i>
											Konfirmasi Hapus Data</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<form action="<?= base_url('kartu/delete') ?>" method="post">
										<div class="modal-body">
											<input type="hidden" name="id" value="<?= $row->id ?>">
											Apakah anda ingin menghapus data kartu '<span class="text-danger"><?= $row->kartu_uid ?></span>' ?
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
						<th>kartu</th>
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