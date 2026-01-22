<section class="content">
  <div class="card card-primary card-outline">
    <div class="card-header">
        <p><?php echo lang('edit_group_subheading');?></p>
    </div>
    <div class="card-body">
    <?php echo form_open(uri_string());?>

      <p>
            <?php echo lang('edit_group_name_label', 'group_name');?> <br />
            <?php echo form_input($group_name);?>
      </p>

      <p>
            <?php echo lang('edit_group_desc_label', 'group_description');?> <br />
            <?php echo form_textarea($group_description);?>
      </p>

    <div class="card-footer">
      <button type="submit" class="btn btn-primary pull-right"><?=lang('edit_group_submit_button');?></button>
      <a href="<?= base_url(); ?>admin/user_permissions/" id="cancel" name="cancel" class="btn btn-default pull-right" style="margin-right: 5px;"><?=lang('edit_group_cancel_button');?></a>
    </div>
<?php echo form_close();?>
</div>
</div>
</section>