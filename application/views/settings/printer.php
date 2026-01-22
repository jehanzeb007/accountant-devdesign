<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary card-outline">
        <!-- <div class="card-header with-border">
          <h3 class="card-title"><?= lang('settings_views_printer_title'); ?></h3>
        </div> -->
        <!-- /.card-header -->
        <div class="card-body">
            <?= form_open(); ?>
            <div class="row">
            	<div class="col-md-6">
	            	<fieldset>
			        		<legend><?= lang('settings_views_printer_legend_paper_size'); ?></legend>
			        		<div class="form-group">
					          <label for="height"><?= lang('settings_views_printer_label_height'); ?></label>
					          <div class="input-group">
					         		<input type="text" class="form-control" id="height" name="height" value="<?= $account_settings->print_paper_height ?>">
					         		<div class="input-group-append">
						         		<span class="input-group-text"><?= lang('settings_views_printer_label_inches'); ?></span>
						         	</div>
					          </div>
					        </div>
					        <div class="form-group">
					          <label for="width"><?= lang('settings_views_printer_label_width'); ?></label>
					          <div class="input-group">
					         		<input type="text" class="form-control" id="width" name="width" value="<?= $account_settings->print_paper_width ?>">
					         		<div class="input-group-append">
						         		<span class="input-group-text"><?= lang('settings_views_printer_label_inches'); ?></span>
						         	</div>
					          </div>
					        </div>
			        	</fieldset>
            	</div>
            	<div class="col-md-6">
            		<fieldset>
				      		<legend><?= lang('settings_views_printer_legend_output'); ?></legend>
				      		  <div class="form-group">
						          <label for="orientation"><?= lang('settings_views_printer_label_orientation'); ?></label>
						          <select class="form-control" name="orientation">
						          	<option value="P" <?= ($account_settings->print_orientation == 'P') ? 'selected' : ''; ?>><?= lang('settings_views_printer_option_portrait'); ?></option>
						          	<option value="L" <?= ($account_settings->print_orientation == 'L') ? 'selected' : ''; ?>><?= lang('settings_views_printer_option_landscape'); ?></option>
						          </select>
						        </div>

						        <div class="form-group">
						          <label for="output"><?= lang('settings_views_printer_legend_output_format'); ?></label>
						          <select class="form-control" name="output">
						          	<option value="H" <?= ($account_settings->print_page_format == 'H') ? 'selected' : ''; ?>><?= lang('settings_views_printer_option_html'); ?></option>
						          	<option value="T" <?= ($account_settings->print_page_format == 'T') ? 'selected' : ''; ?>><?= lang('settings_views_printer_option_text'); ?></option>
						          </select>
						        </div>
				      	</fieldset>
            	</div>
            	<div class="col-md-12">
	            	<fieldset>
				       		<legend><?= lang('settings_views_printer_legend_paper_margin'); ?></legend>
				       		<div class="row">
				       			<div class="col-md-6">
					       			<div class="form-group">
						          	<label for="top"><?= lang('settings_views_printer_label_top'); ?></label>
							          <div class="input-group">
							         		<input type="text" class="form-control" id="top" name="top" value="<?= $account_settings->print_margin_top ?>">
							         		<div class="input-group-append">
								         		<span class="input-group-text"><?= lang('settings_views_printer_label_inches'); ?></span>
								         	</div>
							          </div>
							        </div>
					       		</div>
					       		<div class="col-md-6">
					       			<div class="form-group">
							          <label for="bottom"><?= lang('settings_views_printer_label_bottom'); ?></label>
							          <div class="input-group">
							         		<input type="text" class="form-control" id="bottom" name="bottom" value="<?= $account_settings->print_margin_bottom ?>">
								         	<div class="input-group-append">
								         		<span class="input-group-text"><?= lang('settings_views_printer_label_inches'); ?></span>
								         	</div>
							          </div>
							        </div>
					       		</div>
					       		<div class="col-md-6">
					       			<div class="form-group">
							          <label for="left"><?= lang('settings_views_printer_label_left'); ?></label>
							          <div class="input-group">
							         		<input type="text" class="form-control" id="left" name="left" value="<?= $account_settings->print_margin_left ?>">
							         		<div class="input-group-append">
								         		<span class="input-group-text"><?= lang('settings_views_printer_label_inches'); ?></span>
								         	</div>
							          </div>
							        </div>
					       		</div>
					       		<div class="col-md-6">
					       			<div class="form-group">
							          <label for="right"><?= lang('settings_views_printer_label_right'); ?></label>
							          <div class="input-group">
							         		<input type="text" class="form-control" id="right" name="right" value="<?= $account_settings->print_margin_right ?>">
							         		<div class="input-group-append">
								         		<span class="input-group-text"><?= lang('settings_views_printer_label_inches'); ?></span>
								         	</div>
							          </div>
							        </div>
					       		</div>
				       		</div>
				       	</fieldset>
            	</div>
            </div>
        </div>
        <div class="card-footer">
        	<div class="form-group">
	            <?php
	            echo form_submit('submit', lang('submit'), array('class'=> 'btn btn-primary float-right'));
	            ?>
            </div>
            <?= form_close(); ?>
        </div>
      </div>
  	</div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->

