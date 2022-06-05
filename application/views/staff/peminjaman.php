<!-- page content - HALAMAN UTAMA ISI DISINI -->
<div class="right_col" role="main">
	<h4 class="breadcrumb">Peminjaman Aktif</h4>
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
							<h5 class="modal-title">Tambah data peminjaman loker</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="<?= base_url('peminjaman/create') ?>" method="post">
							<div class="modal-body">
								<div class="form-group">
									<label for="mahasiswa">Mahasiswa</label>
									<select class="form-control select2" name="nim" id="mahasiswa">
										<?php
										foreach($mahasiswa as $mhs):
									?>
										<option value="<?= $mhs->nim ?>"><?= $mhs->nim . ' - ' . $mhs->nama ?></option>
										<?php endforeach ?>
									</select>
								</div>

								<div class="form-group">
									<label for="kartu">Kartu</label>
									<select class="form-control select2" name="kartu" id="kartu">
										<?php
										foreach($loker as $card):
									?>
										<option value="<?= $card->kartu_uid . '_' . $card->loker_id ?>">
											<?= $card->kartu_uid . ' - ' . $card->loker_id ?></option>
										<?php endforeach ?>
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
						<th>Mahasiswa</th>
						<th>UID Kartu</th>
						<th>Loker</th>
						<th>Status</th>
						<th>IN</th>
						<th>OUT</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
                        $no = 1;
						
						foreach($peminjaman as $row):
                    ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= '(' . $row->nim . ') ' . $row->nama ?></td>
						<td><?= $row->kartu ?></td>
						<td><?= $row->loker ?></td>
						<td>
							<?php 
								if($row->status == 'dipakai'):
							?>
							<span class="badge badge-pill badge-warning">Sedang digunakan</span>
							<?php else: ?>
							<span class="badge badge-pill badge-success">Selesai</span>

							<?php endif; ?>
						</td>
						<td><?= date('d M Y (H:i)', strtotime($row->in)) ?></td>
						<td><?= $row->out == null ? '-' : date('d M Y (H:i)', strtotime($row->out))  ?></td>
						<td>
							<?php if($row->status == 'dipakai'): ?>
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-success" data-toggle="modal"
								data-target="#model_<?= $row->id ?>">
								<i class="fa fa-check-circle-o" aria-hidden="true"></i> Selesai
							</button>
							<?php else: echo '-'; endif; ?>
						</td>
					</tr>

					<!-- Modal -->
					<div class="modal fade" id="model_<?= $row->id ?>" tabindex="-1" role="dialog"
						aria-labelledby="modelTitleId" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title"><i class="fa fa-question-circle-o" aria-hidden="true"></i>
										Modal Pengembalian</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="<?= base_url('peminjaman/return') ?>" method="post">
									<div class="modal-body">
										<input type="hidden" name="id" value="<?= $row->id ?>">
										Apakah anda ingin mengkonfirmasi pengembalian kunci loker oleh '<?= $row->nama ?>' ?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Return</button>
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
