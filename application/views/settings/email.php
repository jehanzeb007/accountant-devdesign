<script type="text/javascript">
$(document).ready(function() {
	if (localStorage.getItem('useDefault') == 1) {
		$('#SettingEmailUseDefault').iCheck('check');
		useDefaultMethod(true);
	} else {
		$('#SettingEmailUseDefault').iCheck('uncheck');
		useDefaultMethod(false);
	}

	/* If use default email is checked then disable rest of the fields */
	$('#SettingEmailUseDefault').on('ifChanged', function(event){
      	if (event.target.checked){
      		useDefaultMethod(true);
      	} else {
      		useDefaultMethod(false);
      	}
    });
});

function useDefaultMethod(checked) {
	if (checked === true) {
		localStorage.setItem('useDefault', 1);
		$('#SettingEmailTls').iCheck('disable');
	} else {
		localStorage.setItem('useDefault', 0);
		$('#SettingEmailTls').iCheck('enable');
	}

	$('#SettingEmailProtocol').prop('disabled', checked);
	$('#SettingEmailHost').prop('disabled', checked);
	$('#SettingEmailPort').prop('disabled', checked);
	$('#SettingEmailUsername').prop('disabled', checked);
	$('#SettingEmailPassword').prop('disabled', checked);
	$('#SettingEmailFrom').prop('disabled', checked);
	
}
</script>
<!-- Main content -->
<section class="content">
	<div class="row">
    	<div class="col-md-12">
    		<div class="card card-primary card-outline">
    			<?php echo form_open(); ?>
    			<!-- <div class="card-header with-border">
    				<h3 class="card-title"><?= lang('email_settings'); ?></h3>
    			</div> -->
    			<?php // echo "<pre>"; print_r($account_settings); die(); ?>
    			<!-- /.card-header -->
    			<div class="card-body">
    				<div class="email form">
    					<div class="form-group" style="width: 25%;">
    						<div class="input-group">
    							<label><input type="checkbox" <?= ($account_settings->email_use_default == '1') ? "checked" : "" ?> class="" name="email_use_default" value="1" id="SettingEmailUseDefault"><?= lang('use_default_email_settings'); ?></label>
    							<div class="input-group-append" style="margin-left: 10px;">
			                        <span class="input-group-text">
			                            <i class="fas fa-info-circle" data-toggle="tooltip" title="<?php echo lang('use_default_email_settings_tooltip');?>"></i>
			                        </span>
			                    </div>
    						</div>
    						<!-- /.input group -->
    					</div>
    					<!-- /.form group -->
    					<div class="row">
    						<div class="col-md-4">
    							<div class="form-group">
    								<label for="email_protocol"><?= lang('email_protocol'); ?></label>
    								<select name="email_protocol" id="SettingEmailProtocol" class="form-control">
    									<option value="smtp" <?= ($account_settings->email_protocol == 'smtp') ? "selected" : "" ?>><?= lang('smtp'); ?></option>
    									<option value="mail" <?= ($account_settings->email_protocol == 'mail') ? "selected" : "" ?>><?= lang('mail_function'); ?></option>
    								</select>
    							</div>
    							<div class="form-group">
    								<label for="smtp_host"><?= lang('smtp_host'); ?></label>
    								<input type="text" class="form-control" id="SettingEmailHost" name="smtp_host" value="<?= $account_settings->email_host ?>" placeholder="<?= lang('enter_host'); ?>">
    							</div>
    							<div class="form-group">
    								<label for="smtp_port"><?= lang('smtp_port'); ?></label>
    								<input type="text" class="form-control" id="SettingEmailPort" name="smtp_port" value="<?= $account_settings->email_port ?>" placeholder="<?= lang('enter_port'); ?>">
    							</div>
    						</div>
    						<div class="col-md-4">
    							<div class="form-group">
    								<label for="email_from"><?= lang('smtp_email'); ?></label>
    								<input type="text" class="form-control" id="SettingEmailFrom" value="<?= $account_settings->email_from ?>" name="email_from"  name="email_from" placeholder="<?= lang('enter_email'); ?>">
    							</div>
    							<div class="form-group">
    								<label for="smtp_password"><?= lang('smtp_password'); ?></label>
    								<input type="text" class="form-control" id="SettingEmailPassword" value="<?= $account_settings->email_password ?>" name="smtp_password" placeholder="<?= lang('enter_password'); ?>">
    							</div>
    						</div>
    						<div class="col-md-4">
    							<div class="form-group">
    								<label for="smtp_username"><?= lang('smtp_username'); ?></label>
    								<input type="text" class="form-control" id="SettingEmailUsername" value="<?= $account_settings->email_username ?>" name="smtp_username" placeholder="<?= lang('enter_username'); ?>">
    							</div>
    							<div class="form-group" style="margin-top: 50px;">
    								<label><input type="checkbox" class="" id="SettingEmailTls" name="smtp_tls" <?= ($account_settings->email_tls) ? "checked" : "" ?>><?= lang('use_tls'); ?></label>
    							</div>
    							<!-- /.form group -->
    						</div>
    					</div>
    				</div>
    				<!-- /.card-body -->
    			</div>
    			<div class="card-footer">
					<button type="submit" class="btn btn-primary float-right"><?= lang('submit'); ?></button>
				</div>
				<!-- /.card-footer -->
				<?= form_close(); ?>
    		</div>
			<!-- /.card -->
      	</div>
      	<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->

