<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary card-outline">
        <!-- <div class="card-header with-border">
          <h3 class="card-title"><?= lang('lock_account_title'); ?></h3>
        </div> -->
        <!-- /.card-header -->
        <div class="card-body">
          <?= form_open(); ?>
            <div class="form-group">
              <input type="hidden" value="0" name="locked">
              <label><input type="checkbox" value="1" name="locked" <?= ($locked) ? 'checked' : '' ?>> <?= lang('lock_account_btn'); ?></label>
              <span class="help-block"><?= lang('lock_account_span'); ?></span>
            </div>
            
        </div>
        <div class="card-footer">
          <div class="form-group">
            <?php
            echo form_submit('submit', 'Submit', array('class'=> 'btn btn-primary float-right'));
            ?>
          </div>
          <?= form_close(); ?>
        </div>
      </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->