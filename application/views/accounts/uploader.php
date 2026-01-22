<!-- Main content -->
<section class="content">
    <div class="card card-primary card-outline">
        <div class="card-header with-border">
            <h4><?= lang('accounts_importer_heading'); ?></h4>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php echo form_open_multipart('accounts/uploader'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="accountcsv"><?= lang('select_csv_file'); ?></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="accountcsv" class="custom-file-input" id="accountcsv">
                                <label class="custom-file-label" for="accountcsv"><?= lang('choose_file'); ?></label>
                            </div>
                            <div class="input-group-append">
                                <a href="<?= base_url().'accounts/download/import.csv'?>" class="btn btn-info"><?=lang('accounts_importer_sample_button');?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right"><?=lang('submit');?></button>
            <a href="<?= base_url(); ?>accounts/index" id="cancel" name="cancel" class="btn btn-danger float-right" style="margin-right: 5px;"><?=lang('accounts_importer_cancel_button');?></a>
        </div>
        <!-- /.card-footer -->
        <?php echo form_close(); ?>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->