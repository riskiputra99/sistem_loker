<!-- footer content -->
<footer>
	<div class="pull-right">
		Copyright @ 2021 <?= print_r($jan[0]->jml) ?>
	</div>
	<div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="<?= base_url() ?>assets/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url() ?>assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url() ?>assets/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?= base_url() ?>assets/nprogress/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="<?= base_url() ?>assets/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url() ?>assets/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="<?= base_url() ?>assets/skycons/skycons.js"></script>
<!-- Custom Theme Scripts -->
<script src="<?= base_url() ?>assets/js/custom.min.js"></script>

<!-- Apex Chart -->
<script src="<?= base_url() ?>assets/apexchart/apexcharts.js"></script>

<!-- DataTable -->
<script src="<?= base_url() ?>assets/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/datatables/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/datatables/dataTables.buttons.min.js"></script>

<!-- Select2 -->
<script src="<?= base_url() ?>assets/select2/js/select2.full.min.js"></script>

<!-- Page Script -->
<?php
	if (isset($realtime)) {
?>
	<script>
		var update = function() {
			$.ajax({
				type : 'GET',
				url : '<?=base_url();?>api/realtime',
				success : function(data){
					//console.log(data);
					document.getElementById("realtime-loker").innerHTML = data;
				},
			});
		};
		update();
		var refInterval = window.setInterval('update()', 2000); // 2 seconds
	</script>
<?php
	}
?>

<script>
	$(document).ready(function () {
		// DataTable
		$('.dataTable').DataTable({
			'responsive': true
		});

		//Initialize Select2 Elements
		$('.select2').select2({
			theme: 'bootstrap4',
			width: '100%'
		})

		var options = {
			series: [{
				name: 'Jumlah Kunjungan',
				data: [
					<?= $jan[0]->jml ?>,
					<?= $feb[0]->jml ?>,
					<?= $mar[0]->jml ?>,
					<?= $apr[0]->jml ?>,
					<?= $may[0]->jml ?>,
					<?= $jun[0]->jml ?>,
					<?= $jul[0]->jml ?>,
					<?= $aug[0]->jml ?>,
					<?= $sep[0]->jml ?>,
					<?= $oct[0]->jml ?>,
					<?= $nov[0]->jml ?>,
					<?= $dec[0]->jml ?>,
				]
			}],
			chart: {
				type: 'bar',
				height: 350
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: '55%',
					endingShape: 'rounded'
				},
			},
			dataLabels: {
				enabled: false
			},
			stroke: {
				show: true,
				width: 2,
				colors: ['transparent']
			},
			xaxis: {
				categories: ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct','Nov','Dec'],
			},
			yaxis: {
				title: {
					text: 'Jumlah Peminjam'
				}
			},
			fill: {
				opacity: 0.5,
				colors: ['#1ABB9C']
			},
			tooltip: {
				y: {
					formatter: function (val) {
						return  val + " orang"
					}
				}
			}
		};

		var chart = new ApexCharts(document.querySelector("#chart"), options);
		chart.render();
	});

</script>
</body>

</html>
