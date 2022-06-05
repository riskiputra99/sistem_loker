<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<div class="profile clearfix">
							<div class="profile_pic">
								<img src="<?= base_url() ?>assets/images/profile/<?= $this->session->photo; ?>" alt="..."
									class="img-circle profile_img">
							</div>
							<div class="profile_info">
								<span>Welcome, <?= $this->session->nama; ?></span>
							</div>
						</div>
					</div>
					<div class="clearfix">
					</div>
					<br>
					<br>
					<!-- menu profile quick info -->

					<!-- /menu profile quick info -->

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<ul class="nav side-menu">
								<li class="<?= $active == 'home' ? 'current-page' : null ?>">
									<a href="<?= base_url('staff') ?>"><i class="fa fa-home"></i> Home</a>
								</li>

								<li class="<?= $active == 'mahasiswa' ? 'current-page' : null ?>">
									<a href="<?= base_url('staff/mahasiswa') ?>"><i class="fa fa-users"></i> Anggota </a>
								</li>

								<li class="<?= $active == 'peminjaman' ? 'current-page' : null ?>">
                                    <a>
                                        <i class="fas fa-folder    "></i> Peminjaman <span class="fa fa-chevron-down"></span>
                                    </a>
									<ul class="nav child_menu">
										<li>
                                            <a href="<?= base_url('staff/peminjaman') ?>"><i class="fas fa-check-circle"></i> Peminjaman Aktif</a>
                                        </li>
										<li>
                                            <a href="<?= base_url('staff/riwayat') ?>"><i class="fas fa-receipt"></i> Riwayat Peminjaman</a>
                                        </li>
									</ul>
								</li>

                                <li class="<?= $active == 'profile' ? 'current-page' : null ?>">
									<a href="<?= base_url('staff/profile') ?>"><i class="fa fa-user"></i> Profile </a>
								</li>

                                <li class="">
									<a href="<?= base_url('auth/logout') ?>"><i class="fa fa-power-off"></i> Log out </a>
								</li>
							</ul>
						</div>
					</div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<div class="sidebar-footer hidden-small">
					</div>
					<!-- /menu footer buttons -->
				</div>
			</div>
