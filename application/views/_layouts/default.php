<?php $this->load->view('_partials/navbar'); ?>
   
<div class="content-wrapper">
	
	<!-- <section class="content-header">
		<?php if (validation_errors()) { ?>
	      	<div class="alert alert-danger">
	          	<button data-dismiss="alert" class="close" type="button">×</button>
	          	<?= validation_errors(); ?>
	      	</div>
	  	<?php } ?>
		<?php if ($this->session->flashdata('message')) { ?>
	      	<div class="alert alert-success">
	          	<button data-dismiss="alert" class="close" type="button">×</button>
	          	<?= $_SESSION['message']; ?>
	      	</div>
	  	<?php } ?>
	  	<?php if ($this->session->flashdata('error')) { ?>
	      	<div class="alert alert-danger">
	          	<button data-dismiss="alert" class="close" type="button">×</button>
	          	<?= ($_SESSION['error']); ?>
	      	</div>
	  	<?php } ?>
	  	<?php if ($this->session->flashdata('warning')) { ?>
	      	<div class="alert alert-warning">
	          	<button data-dismiss="alert" class="close" type="button">×</button>
	          	<?= ($_SESSION['warning']); ?>
	      	</div>
	 	<?php } ?>
	</section> -->

	<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1><?= ($ctrler == 'dashboard' ? '<h1>'.$dashboard_title.'</h1><p>Address: '. ($this->mAccountSettings->address) . ' Email: ' . ($this->mAccountSettings->email) . '</p>' : $page_title); ?></h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            	<li class="breadcrumb-item "><a href="<?= base_url('#'); ?>">Home</a></li>
              <?php if ($action !== 'index') { ?>
              	<li class="breadcrumb-item "><a href="<?= ($this->session->userdata('active_account')) ? base_url($ctrler.'/'.$action) : base_url('#'); ?>"><?= humanize($ctrler); ?></a></li>
              <?php } else { ?>
              	<li class="breadcrumb-item active"><?= humanize($ctrler); ?></li>
              <?php } ?>
              <?php if ($action !== 'index') { ?>
              	<li class="breadcrumb-item active"><?= humanize($action); ?></li>
              <?php } ?>
             		<li class="breadcrumb-item active"><?= $action; ?></li> 
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
	<?php $this->load->view($inner_view); ?>
</div>
<?php $this->load->view('_partials/footer'); ?>
<?php 
	if ($view_log)
	{
		$this->load->view('_partials/right_navbar');
	}
?>