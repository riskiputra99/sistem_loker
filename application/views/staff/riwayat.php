<!-- page content - HALAMAN UTAMA ISI DISINI -->
<div class="right_col" role="main">
	<h4 class="breadcrumb">Riwayat Peminjaman Loker</h4>
	<div class="card">
		<div class="card-body">
			<table class="table table-striped table-bordered dataTable" style="width:100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Mahasiswa</th>
						<th>UID Kartu</th>
						<th>Loker</th>
						<th>Status</th>
						<th>Tanggal</th>
						<th>IN</th>
						<th>OUT</th>
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
						<td><?= date('d M Y', strtotime($row->in)) ?></td>
						<td><?= date('H:i', strtotime($row->in)) ?></td>
						<td><?= $row->out == null ? '-' : date('H:i', strtotime($row->out))  ?></td>
					</tr>

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
						<th>Tanggal</th>
						<th>IN</th>
						<th>OUT</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<!-- /page content -->
