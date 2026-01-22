  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light">
    <div class="card card-solid">
      <div class="card-header with-border">
        <i class=""></i>
        <h3 class="card-title"><?=lang('right_sidebar_menu_activity_log');?></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
          <?php
            if (count($logs) <= 0) {
              echo 'Nothing here.';
            } else {
              echo '<dl class="dl-horizontal">';
              foreach ($logs as $row => $data) {
                if ($row >= 24) {
                  echo "<dd><a href=".base_url('accounts/log')." class='btn btn-default btn-link pull-right'>".lang('right_sidebar_menu_view_all_log').'</a></dd>';
                  break;
                }
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
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

<!-- <aside class="control-sidebar control-sidebar-light" style="top: 57px; height: 321px; display: block;">
  <div class="p-3 control-sidebar-content os-host os-theme-light os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition os-host-overflow os-host-overflow-y" style="height: 321px;" bis_skin_checked="1">
    <div class="os-resize-observer-host observed" bis_skin_checked="1">
      <div class="os-resize-observer" style="left: 0px; right: auto;" bis_skin_checked="1">
      </div>
    </div>
    <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;" bis_skin_checked="1">
      <div class="os-resize-observer" bis_skin_checked="1"></div>
    </div>
  </div>
</aside> -->



  <style type="text/css">
    .dl-horizontal{
      overflow: auto;
      /*max-height: 500px;*/
    }
  </style>
