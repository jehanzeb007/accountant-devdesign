<!-- <script src="<?= base_url(); ?>assets/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/datatables/extensions/Buttons/js/buttons.bootstrap.min.js"></script> -->
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary card-outline">
        <div class="card-header with-border">
          <h3 class="card-title"><?=lang('user_permission_heading');?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-striped custom-table" id="userGroup">
              <thead>
                <th><?= lang('user_permission_table_id'); ?></th>
                <th><?= lang('user_permission_table_group'); ?></th>
                <th><?= lang('user_permission_table_action'); ?></th>
              </thead>
              <tbody>
                <?php foreach ($permissions as $key => $permission): ?>
                  <tr>
                    <td><strong><?= $permission->id; ?></strong></td>
                    <td><?= $permission->description; ?></td>
                    <td><a href="<?= base_url(); ?>admin/edit_group/<?= $permission->gp_id; ?>" style="margin-right: 3px;"><i class="fas fa-edit" data-toggle="tooltip" title="<?=lang('user_permission_edit_group_tooltip');?>"></i></a><a style="margin-right: 3px;" href="<?= base_url(); ?>admin/edit_permission/<?= $permission->gp_id; ?>"><i class="fas fa-cog" data-toggle="tooltip" title="<?=lang('user_permission_edit_group_permission_tooltip');?>"></i></a><a href="<?= base_url(); ?>admin/delete_group/<?= $permission->gp_id; ?>"><i class="fas fa-trash" data-toggle="tooltip" title="<?=lang('user_permission_delete_group_tooltip');?>"></i></a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
             <tfoot>
                <th><?= lang('user_permission_table_id'); ?></th>
                <th><?= lang('user_permission_table_group'); ?></th>
                <th><?= lang('user_permission_table_action'); ?></th>
              </tfoot>
            </table>
        </div>
      </div>
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<script type="text/javascript">
    $(document).ready(function() {

      $.fn.dataTable.ext.buttons.create =
      {
        className: 'btn',
        id: 'CreateGroupButton',
        text: "<i class='fas fa-users'></i> <?=lang('user_permission_add_group_btn');?>",
        action: function (e, dt, node, config)
        {
          //This will send the page to the location specified
          window.location.href = 'admin/create_group';
        }
      };

      $('#userGroup').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      dom: 'Bfrtip',
        buttons: [
            'create',
        ],
      "columnDefs": [
        { "width": "10px", "targets": 0 },
        { "width": "20px", "targets": 2 }
      ]
      });
    });
</script>