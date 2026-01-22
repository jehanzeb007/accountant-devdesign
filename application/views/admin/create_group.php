<section class="content">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <p><?php echo lang('create_group_subheading');?></p>
        </div>
        <div class="card-body">
            <?php echo form_open("admin/create_group");?>
            <p>
                <?php echo lang('create_group_name_label', 'group_name');?> <br />
                <?php echo form_input($group_name);?>
            </p>
            <p>
                <?php echo lang('create_group_desc_label', 'description');?> <br />
                <?php echo form_textarea($description);?>
            </p>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right"><?=lang('submit');?></button>
                <a href="<?= base_url(); ?>admin/user_permissions/" id="cancel" name="cancel" class="btn btn-danger float-right" style="margin-right: 5px;"><?=lang('create_account_cancel_button');?></a>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</section>