<!-- page content - HALAMAN UTAMA ISI DISINI -->
<div class="right_col" role="main">
	<h4 class="breadcrumb">Profile</h4>

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

	<div class="row">
		<div class="col-md-3 mb-4">

			<!-- Profile Image -->
			<div class="card card-primary card-outline">
				<div class="card-body box-profile">
					<div class="text-center">
						<img class="profile-user-img img-fluid img-circle"
							src="<?= base_url() ?>assets/images/profile/<?= $this->session->photo; ?>"
							style="width: 70%" alt="User profile picture">
					</div>

					<h3 class="profile-username text-center"><?= $this->session->nama; ?></h3>

					<p class="text-muted text-center"><?= ucfirst($this->session->role) ?></p>

				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- /.col -->
		<div class="col-md-9">
			<div class="card">
				<div class="card-header p-2">
					<ul class="nav nav-pills">
						<li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profile</a>
						</li>
						<li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Ganti
								Password</a></li>
					</ul>
				</div><!-- /.card-header -->
				<div class="card-body">
					<div class="tab-content">
						<div class="tab-pane active" id="profile">
							<form class="form-horizontal" method="POST"
								action="<?= base_url('auth/update_profile/staff') ?>" enctype="multipart/form-data">
								<input type="hidden" name="username" value="<?= $this->session->username; ?>">

								<div class="form-group row">
									<label for="inputName" class="col-sm-4 col-form-label">Nama</label>
									<div class="col-sm-8">
										<input type="text" name="nama" value="<?= $this->session->nama; ?>"
											class="form-control" id="inputName" placeholder="Nama...">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputPhoto" class="col-sm-4 col-form-label">Photo</label>
									<div class="col-sm-8">
										<input type="file" name="photo" id="photo">
									</div>
								</div>

								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</form>
						</div>

						<div class="tab-pane" id="change_password">
							<form class="form-horizontal" method="POST"
								action="<?= base_url('auth/change_password/staff') ?>">
								<input type="hidden" name="username" value="<?= $this->session->username; ?>">

								<div class="form-group row">
									<label for="inputPasswordLama" class="col-sm-4 col-form-label">Password Lama</label>
									<div class="col-sm-8">
										<input type="password" maxlength="16" name="password_lama" class="form-control"
											id="inputPasswordLama" placeholder="Password Lama">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputPasswordBaru" class="col-sm-4 col-form-label">Password Baru</label>
									<div class="col-sm-8">
										<input type="password" maxlength="16" name="password_baru" class="form-control"
											id="inputPasswordBaru" placeholder="Password Baru">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputPasswordKonfirmasi" class="col-sm-4 col-form-label">Password
										Konfirmasi</label>
									<div class="col-sm-8">
										<input type="password" maxlength="16" name="password_konfirmasi"
											class="form-control" id="inputPasswordKonfirmasi"
											placeholder="Password Konfirmasi">
									</div>
								</div>

								<div class="form-group row">
									<div class="offset-sm-4 col-sm-8">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /.tab-pane -->
					</div>
					<!-- /.tab-content -->
				</div><!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- /.col -->
	</div>
</div>
<!-- /page content -->
