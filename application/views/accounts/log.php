<!-- Main content -->
<section class="content">

  <div class="card card-outline card-primary text-center">
    <div class="card-header with-border">
      <h3 class="text-center"> <?=lang('accounts_log_heading');?> <i class="fa fa-history"></i></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <?php
        if (count($logs) <= 0) {
          echo lang('no_records_found');
        } else {
          echo '<dl class="dl-horizontal">';
          foreach ($logs as $row => $data) {
            echo '<dt>' . $data['date'] . '</dt>';
            echo '<dd>' . $data['message'] . '</dd>';
          }
          echo '</dl>';
        }
      ?>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->