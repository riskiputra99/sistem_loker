<!-- page content - HALAMAN UTAMA ISI DISINI -->
<div class="right_col" role="main">
	<h4 class="breadcrumb">Dashboard Staff</h4>

    <div class="row mt-4">
        <div class="col-md-8 col-sm-12">
            <div class="row" id="realtime-loker">
                <?php 
                    foreach($loker as $lok): 
                        if($lok->status == 'kosong'):
                ?>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">
                                Loker <?= $lok->kode_loker ?>
                            </h5>
                        </div>
                        <div class="card-body" style="background-color: green; height: 70px">
                            <h6 class="text-center text-white">Kosong</h6>
                        </div>
                    </div>
                </div>

                <?php 
                        else:
                ?>

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">
                                Loker <?= $lok->kode_loker ?>
                            </h5>
                        </div>
                        <div class="card-body"style="background-color:crimson; height: 70px">
                            <h6 class="text-center text-white">Dipakai</h6>
                        </div>
                    </div>
                </div>

                <?php 
                        endif;
                    endforeach; 
                ?>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <h5 class="text-secondary">Peminjaman Terakhir</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mhs</th>
                            <th>Loker</th>
                            <th>Created at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            foreach($peminjaman as $row):
                        ?>
                        <tr>
                            <td scope="row"><?= $no++ ?></td>
                            <td><?= $row->nama . ' (' . $row->nim . ')' ?></td>
                            <td><?= $row->loker ?></td>
                            <td><?= date('d M Y (H:i)', strtotime($row->created_at)) ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
