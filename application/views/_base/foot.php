<script type="text/javascript">
$(function () {
    $('input[type="checkbox"],[type="radio"]').not('.skip').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });

    // $('input[type="checkbox"],[type="radio"]').not('.skip').iCheck({
    //   checkboxClass: 'icheckbox_square-blue',
    //   radioClass: 'iradio_square-blue',
    //   increaseArea: '20%' // optional
    // });
});
$(document).ready(function () {
  bsCustomFileInput.init()
});

$(document).ready(function(){
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	});
	toastr.options = {
	  "closeButton": false,
	  "debug": false,
	  "newestOnTop": true,
	  "progressBar": true,
	  "positionClass": "toast-bottom-right",
	  "preventDuplicates": true,
	  "onclick": null,
	  "showDuration": "500",
	  "hideDuration": "500",
	  "timeOut": "2500",
	  "extendedTimeOut": "500",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "slideDown",
	  "hideMethod": "hide"
	};
	<?php if($this->session->flashdata('message')){ ?>
		toastr["success"]("<?php echo $this->session->flashdata('message'); ?>", "<?php echo lang('toastr_success_heading'); ?>");
	<?php } $this->session->unset_userdata('message');?>

	<?php if($this->session->flashdata('error')){  ?>
		toastr["error"]("<?php echo $this->session->flashdata('error'); ?>", "<?php echo lang('toastr_error_heading'); ?>");
	<?php } $this->session->unset_userdata('error');?>

	<?php if($this->session->flashdata('warning')){  ?>
		toastr["warning"]("<?php echo $this->session->flashdata('warning'); ?>", "<?php echo lang('toastr_warning_heading'); ?>");
	<?php } $this->session->unset_userdata('warning');?>
	<?php if($this->session->flashdata('info')){  ?>
		<?php if (is_array($this->session->flashdata('info'))) { ?>
			<?php foreach ($this->session->flashdata('info') as $value) { ?>
				toastr["info"]("<?php echo $value; ?>", "<?php echo lang('toastr_info_heading'); ?>");
			<?php } ?>
		<?php }else{ ?>
			toastr["info"]("<?php echo $this->session->flashdata('info'); ?>", "<?php echo lang('toastr_info_heading'); ?>");
		<?php } ?>
	<?php } $this->session->unset_userdata('info');?>
	<?php if (validation_errors()) { ?>
		<?php $errors = trim(preg_replace('/\s+/', ' ', validation_errors())); ?>
		toastr["info"]("<?php echo $errors; ?>", "<?php echo lang('toastr_info_heading'); ?>");
	<?php } ?>
});
</script>
<?php
$version = '0.0.1';
?>
<!-- Bootstrap -->
<script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js?t=<?=$version?>"></script>

<!-- Pagination.js -->
<script src="<?= base_url(); ?>assets/plugins/paginationjs/pagination.min.js?t=<?=$version?>"></script>

<!-- Morris.js charts -->
<script src="<?= base_url(); ?>assets/plugins/raphael/raphael.js?t=<?=$version?>"></script>
<script src="<?= base_url(); ?>assets/plugins/morris/morris.min.js?t=<?=$version?>"></script>
<!-- Sparkline -->
<script src="<?= base_url(); ?>assets/plugins/sparklines/sparkline.js?t=<?=$version?>"></script>
<!-- jvectormap -->
<script src="<?= base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js?t=<?=$version?>"></script>
<script src="<?= base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js?t=<?=$version?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url(); ?>assets/plugins/jquery-knob/jquery.knob.min.js?t=<?=$version?>"></script>
<!-- daterangepicker -->
<script src="<?= base_url(); ?>assets/plugins/moment/moment.min.js?t=<?=$version?>"></script>
<script src="<?= base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js?t=<?=$version?>"></script>
<!-- datepicker -->
<!-- <script src="<?= base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script> -->

<!-- Bootstrap WYSIHTML5 -->
<!-- <script src="<?= base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
<!-- Slimscroll -->
<script src="<?= base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js?t=<?=$version?>"></script>
<!-- FastClick -->
<script src="<?= base_url(); ?>assets/plugins/fastclick/fastclick.js?t=<?=$version?>"></script>

<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/dist/js/adminlte.js?t=<?=$version?>"></script>
<!-- <script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url(); ?>assets/dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url(); ?>assets/dist/js/demo.js"></script> -->

<!-- Custom JS -->
<script src="<?= base_url(); ?>assets/dist/js/myjs.js?t=<?=$version?>"></script>

<!-- bs-custom-file-input -->
<script src="<?= base_url(); ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js?t=<?=$version?>"></script>

<!-- AdminLTE3 Dashboard3 JS -->
<!-- <script src="<?= base_url(); ?>assets/dist/js/pages/dashboard3.js"></script> -->

</body>
</html>