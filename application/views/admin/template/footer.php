<!-- footer content -->
<footer>
	<div class="pull-right">
		Copyright @ 2021
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
				name: 'Net Profit',
				data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
			}, {
				name: 'Revenue',
				data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
			}, {
				name: 'Free Cash Flow',
				data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
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
				categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
			},
			yaxis: {
				title: {
					text: '$ (thousands)'
				}
			},
			fill: {
				opacity: 1
			},
			tooltip: {
				y: {
					formatter: function (val) {
						return "$ " + val + " thousands"
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
