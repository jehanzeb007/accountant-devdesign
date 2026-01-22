<style type="text/css">
/*   .info-box-icon animation 
  .hover:hover .info-box-icon{
    font-size: 60px;
  }
  .hover .info-box-icon {
    -webkit-transition: all 0.3s linear;
    -o-transition: all 0.3s linear;
    color: rgba(0, 0, 0, 0.35);
  }
   .progress-description position 
  .hover {
    position: relative;
  }
  .progress-description {
    position: absolute;
    margin: 4px 4px;
    left: 95px;
    bottom: 5px;
  }
   .progress-description color 
  .hover:hover .progress-description {
    color: rgba(0, 0, 0, 0.50);
  }

   .info-box-number animation 
  .hover:hover .info-box-number{
    font-size: 22px;
    color: rgba(0, 0, 0, 0.35);
  }
  .hover .info-box-number {
    -webkit-transition: all 0.3s linear;
    -o-transition: all 0.3s linear;
  }*/

</style>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-3">
          <!-- Custom Small Boxes By Omar Khan -->
          <div class="small-box bg-secondary">
            <div class="inner">
              <a href="<?= base_url('admin/create_account');?>" style="color: #ffffff;">
                <h3><?= lang('dashboard_create_account_label'); ?></h3>
                <p><?= lang('dashboard_create_account_label_description'); ?></p>
              </a>
            </div>
            <div class="icon info-box-icon">
              <i class="fas fa-plus-square"></i>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="small-box bg-secondary">
            <div class="inner">
              <a href="<?= base_url('admin/accounts');?>" style="color: #ffffff;">
                <!-- <h3><?= lang('dashboard_manage_account_label'); ?></h3> -->
                <h3><?= count((array)$accounts); ?></h3>
                <p><?= lang('dashboard_manage_account_label_description'); ?></p>
              </a>
            </div>
            <div class="icon info-box-icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="small-box bg-secondary">
            <div class="inner">
              <a href="<?= base_url('admin/users');?>" style="color: #ffffff;">
                <!-- <h3><?= lang('dashboard_manage_user_label'); ?></h3> -->
                <h3><?= $user_count; ?></h3>
                <p><?= lang('dashboard_manage_user_label'); ?></p>
              </a>
            </div>
            <div class="icon info-box-icon">
              <i class="fas fa-users"></i>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="small-box bg-secondary">
            <div class="inner">
              <a href="<?= base_url('admin/settings');?>" style="color: #ffffff;">
                <h3><?= lang('dashboard_general_settings_label'); ?></h3>
                <p><?= lang('dashboard_general_settings_label_description'); ?></p>
              </a>
            </div>
            <div class="icon info-box-icon">
              <i class="fas fa-cogs"></i>
            </div>
          </div> 
        </div>
      </div>


      <!-- TABLE: LATEST ORDERS -->
      <div class="card card-primary card-outline">
        <div class="card-header with-border">
          <h3 class="card-title"><?= lang('dashboard_accountlist_table_heading'); ?></h3>
          <p class="float-right" style="padding-right: 50px;">
            <strong><?= lang('dashboard_accountlist_table_sub_heading') ?><em style="font-size: 18px; padding-left: 30px">"(<?= (isset($_SESSION['active_account'])) ? $_SESSION['active_account']->label : lang('dashboard_accountlist_table_sub_heading_option');?>)"</em></strong>
          </p>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <p style="font-size: 18px; position: absolute;"><?= lang('dashboard_accountlist_table_note'); ?></p>
          <div class="table-responsive">
            <table id="accounts" class="stripped text-center">
              <thead>
                <tr>
                  <th><?= lang('dashboard_accountlist_table_label'); ?></th>
                  <th><?= lang('dashboard_accountlist_table_name'); ?></th>
                  <th><?= lang('dashboard_accountlist_table_fiscal_year'); ?></th>
                  <th><?= lang('dashboard_accountlist_table_status'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($accounts) {
                  foreach ($accounts as $account) {
                    $href = base_url()."user/activate/".$account->id;
                    if ($active_account_id == $account->id) {
                      $href = base_url()."user/deactivate/".$account->id;
                      if ($account->account_locked == 1) {
                        $label = lang('dashboard_accountlist_table_status_label_active_locked');
                        $title = lang('dashboard_accountlist_table_status_tooltip_title_active_locked');
                        $class = 'badge badge-warning';
                        $icon_class = 'fas fa-unlock';
                      }else{
                        $label = lang('dashboard_accountlist_table_status_label_active');
                        $title = lang('dashboard_accountlist_table_status_tooltip_title_active');
                        $class = 'badge badge-success';
                        $icon_class = 'fas fa-check';
                      }
                    }elseif ($account->account_locked == 1) {
                      $label = lang('dashboard_accountlist_table_status_label_locked_inactive');
                      $title = lang('dashboard_accountlist_table_status_tooltip_title_locked_inactive');
                      $class = 'badge badge-danger';
                      $icon_class = 'fas fa-lock';
                    }else{
                      $label = lang('dashboard_accountlist_table_status_label_inactive');
                      $title = lang('dashboard_accountlist_table_status_tooltip_title_inactive');
                      $class = 'badge badge-secondary';
                      $icon_class = 'fas fa-times';
                    }
                ?>
                  <tr>
                    <td><?= "<em>".$account->label."</em>"; ?></td>
                    <td><?= $account->name; ?></td>
                    <td>
                      <?= $this->functionscore->dateFromSql($account->fy_start).lang('dashboard_accountlist_table_fiscal_year_to').$this->functionscore->dateFromSql($account->fy_end); ?>
                    </td>
                    <td>
                      <a href="<?= $href; ?>" data-toggle="tooltip" data-placement="left" title="<?= $title; ?>"><span class="<?= $class; ?>"><?= $label; ?> <i class="<?= $icon_class; ?>"></i></span></a>
                    </td>                    
                  </tr>
                <?php } } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th><?= lang('dashboard_accountlist_table_label'); ?></th>
                  <th><?= lang('dashboard_accountlist_table_name'); ?></th>
                  <th><?= lang('dashboard_accountlist_table_fiscal_year'); ?></th>
                  <th><?= lang('dashboard_accountlist_table_status'); ?></th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <!-- <div class="card-footer">
          <p style="font-size: 18px;"><?= lang('dashboard_accountlist_table_note'); ?></p>
        </div> -->
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </div>
    <!-- ./col-md-4 -->
    <!-- <div class="col-md-8"> -->
      
    <!-- </div> -->
    <!-- ./col-md-8 -->    
  </div>
  <!-- ./row --> 
</section>
<!-- /.content -->
<script>
  $(document).ready(function() {
    var datatables = $('#accounts').DataTable( {
        "sScrollY":       "158px",
        "scrollCollapse": true,
        "paging":         false,
        "info":           false,
        "searching":      true,
        "autoWidth":      true
    });
    $(".sidebar-toggle").click(function() {
      setTimeout(function() {
        datatables.columns.adjust().draw();    
      },310);
    });
    $( ".main-sidebar" ).hover(function() {
      setTimeout(function() {
        datatables.columns.adjust().draw();    
      },310);
    });
  });
</script>