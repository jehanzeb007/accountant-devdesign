<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><?php echo lang('index_subheading');?></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="userlist" class="table table-striped custom-table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><?php echo lang('index_fname_th');?></th>
                                <th><?php echo lang('index_lname_th');?></th>
                                <th><?php echo lang('index_email_th');?></th>
                                <th><?php echo lang('index_groups_th');?></th>
                                <th><?php echo lang('index_status_th');?></th>
                                <th><?php echo lang('index_action_th');?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($users) : ?>
                                <?php foreach ($users as $user):?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
                                        <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
                                        <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
                                        <td>
                                            <?php foreach ($user->groups as $group):?>
                                                <?php echo anchor("admin/edit_permission/".$group->id, '<span class="badge badge-secondary">'.htmlspecialchars($group->description,ENT_QUOTES,'UTF-8').'</span>', "data-toggle='tooltip' title='".lang('index_groups_anchor_tooltip')."'") ;?><br />
                                            <?php endforeach?>
                                        </td>
                                        <?php

                                        if ($user->active) {
                                            $href = "admin/deactivate/".$user->id;
                                            $class = "badge badge-success";
                                            $label = lang('index_active_link');
                                        }else{
                                            $href = "admin/activate/". $user->id;
                                            $class = "badge badge-warning";
                                            $label = lang('index_inactive_link');
                                        }
                                        ?>
                                        <td>
                                            <a href="<?= $href; ?>">
                                                <span class="<?= $class; ?>"><?= $label; ?></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?= base_url(); ?>admin/edit_user/<?= $user->id; ?>">
                                                <i class="fas fa-edit" data-toggle="tooltip" title="<?=lang('index_edit_user_icon');?>"></i>
                                            </a>
                                            <a href="<?= base_url(); ?>admin/delete_user/<?= $user->id; ?>">
                                                <i class="fas fa-trash" data-toggle="tooltip" title="<?=lang('index_delete_user_icon');?>"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th><?php echo lang('index_fname_th');?></th>
                                <th><?php echo lang('index_lname_th');?></th>
                                <th><?php echo lang('index_email_th');?></th>
                                <th><?php echo lang('index_groups_th');?></th>
                                <th><?php echo lang('index_status_th');?></th>
                                <th><?php echo lang('index_action_th');?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTable.ext.buttons.create = {
            className: 'btn',
            id: 'CreateAccountButton',
            text: "<i class='fas fa-user-plus'></i> <?=lang('index_create_user_btn_label');?>",
            action: function (e, dt, node, config) {
                //This will send the page to the location specified
                window.location.href = '<?= base_url(); ?>admin/create_user';
            }
        };

        $.fn.dataTable.ext.buttons.newGroup = {
            className: 'btn',
            id: 'CreateGroupButton',
            text: "<i class='fas fa-users'></i> <?=lang('index_create_group_btn_label');?>",
            action: function (e, dt, node, config) {
                //This will send the page to the location specified
                window.location.href = '<?= base_url(); ?>admin/create_group';
            }
        };

        $('#userlist').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
                'create',
                'newGroup'
            ]
        });
    });
</script>