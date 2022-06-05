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
					'responsive' : true
				});

				//Initialize Select2 Elements
				$('.select2').select2({
					theme: 'bootstrap4',
					width: '100%'
				})
			});
		</script>
	</body>
</html>