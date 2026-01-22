<script>
  function toggle_dark_mode() {
      jQuery.ajax({  
        url:"<?= base_url(); ?>accounts/toggle_dark_mode/",  
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        type: 'POST',
        success:function(data){
          console.log(data);
          if(JSON.parse(data)){
            location.reload(true);    
          }
        }  
      });
    }
</script>
<div class="wrapper">
  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url(); ?>/assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <!-- <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->
      
      <li class="nav-item dropdown">
        <a class="nav-link" href="<?= base_url('user/activate'); ?>"><?=lang('main_header_active_account');?><em style="font-size: 16px;"><strong>(<?= ($this->session->userdata('active_account')) ? $this->session->userdata('active_account')->label : lang('main_header_active_account_NONE');?>)</strong></em></a>
      </li>
      <!-- User Dropdown Menu -->
      <li class="nav-item dropdown user user-menu">
        <a href="#" class="nav-link" data-toggle="dropdown">
          <img src="<?= base_url(); ?>assets/uploads/users/<?= $current_user->image; ?>" class="user-image" alt="User Image">
          <span class="hidden-xs"><?= $current_user->first_name . ' ' . $current_user->last_name; ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <!-- User image -->
          <li class="user-header bg-secondary">
            <img src="<?= base_url(); ?>assets/uploads/users/<?= $current_user->image; ?>" class="img-circle elevation-2" alt="User Image">
            <p>
              <?= $current_user->first_name . ' ' . $current_user->last_name; ?>
              <small><?=  sprintf(lang('main_header_user_dropdown_member_since'), date("D, F jS, Y", $current_user->created_on), date("g:i a", $current_user->created_on));?></small>
            </p>
          </li>
          <!-- Menu Body -->
          
          <!-- Menu Footer-->
          <li class="user-footer row">
            <div class="col-md-6">
              <?php if ($this->ion_auth->is_admin()) { ?>
              <a href="<?= base_url()."admin/edit_user/".$this->session->userdata('user_id'); ?>" class="btn btn-info btn-flat float-left"><?=lang('main_header_user_dropdown_profile_btn_label');?></a>
              <?php }else{ ?>
                <a href="#updateimage_modal" data-toggle="modal" class="btn btn-info btn-flat float-left" style="white-space: nowrap;"><?=lang('main_header_user_dropdown_updateuserimage_btn_label');?></a>
              <?php } ?>
            </div>
            <div class="col-md-6">
              <a href="<?= base_url('login/logout'); ?>" class="btn btn-danger btn-flat float-right"><?=lang('main_header_user_dropdown_logout_btn_label');?></a>
            </div>
          </li>
        </ul>
      </li>
      <li class="nav-item" data-toggle='tooltip' title='<?= lang('fullscreen_tooltip') ?>'>
        <a class="nav-link" data-widget="fullscreen" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="toggle-dark-mode" onclick="toggle_dark_mode();" role="button" data-toggle='tooltip' title='<?= lang('toggle_dark_mode_tooltip') ?>'>
          <i class="fas fa-adjust"></i>
        </a>
      </li>
      <?php if ($uri == 'dashboard/index' && $view_log): ?>
      <li class="nav-item" data-toggle='tooltip' title='<?= lang('syetem_log_tooltip') ?>'>
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa fa-history"></i>
        </a>
      </li>
      <?php endif ?>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url(); ?>" class="brand-link" style="text-align: center;">
      <img src="<?= base_url(); ?>assets/uploads/logo/<?= isset($account_settings) && !empty($account_settings) ? ($account_settings->logo != null && $account_settings->logo != '') ? $account_settings->logo : 'OTSLOGO.png' : 'OTSLOGO.png'; ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?= $settings->sitename ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url(); ?>assets/uploads/users/<?= $current_user->image; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= ($this->ion_auth->is_admin() ? base_url()."admin/edit_user/".$this->session->userdata('user_id') : '#'); ?>" class="d-block"><?= $current_user->first_name . ' ' . $current_user->last_name; ?></a>
        </div>
      </div> -->

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php 
          foreach ($menu as $parent => $parent_params) {
            if ((array_key_exists($parent_params['url'], $page_auth) && $page_auth[$parent_params['url']] == 1 ) || !array_key_exists($parent_params['url'], $page_auth)) {
              if (empty($parent_params['children'])) {
          ?>
          <li class="nav-item">
          <?php if($parent == 'label' or $parent == 'label1') { ?>
                  <li class="nav-header"><?php echo $parent_params['name']; ?></li>
          <?php } else { ?>
                  <a href="<?php echo $parent_params['url']; ?>" class="nav-link <?php if($uri == $parent_params['url']){echo "active";} ?>">
                    <i class="nav-icon <?php echo $parent_params['icon']; ?>"></i>
                    <p>
                      <?php echo $parent_params['name']; ?>
                      <!-- <i class="right fas fa-angle-left"></i> -->
                    </p>
                  </a>
          <?php } ?>
          <?php } else { ?>
            <li class="nav-item <?php if(in_array($action, $parent_params['children'])){ echo "menu-is-opening menu-open active"; } ?>">
              <a href="#" class="nav-link <?php if(in_array($action, $parent_params['children'])){ echo "active"; } ?>">
                <i class="nav-icon <?php echo $parent_params['icon']; ?>"></i>
                <p>
                  <?php echo $parent_params['name']; ?>
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="<?php if(in_array($action, $parent_params['children'])){ echo "display: block;"; } ?>">
                <?php
                if (strpos($parent_params['url'], '/') !== false) {
                  $parent_params['url'] = substr_replace($parent_params['url'], '', strpos($parent_params['url'], '/'), strlen($parent_params['url']));
                }
                foreach ($parent_params['children'] as $name => $url){
                  $child_url = $parent_params['url'].'/'.$url;
                  if ((array_key_exists($child_url, $page_auth) && $page_auth[$child_url] == 1 ) || !array_key_exists($child_url, $page_auth)) { ?>
                    <li class="nav-item">
                      <a href="<?php echo $child_url ?>" class="nav-link <?php if($action == $url){ echo "active"; } ?>">
                        <i class="far fa-circle nav-icon"></i>
                        <p><?php echo $name; ?></p>
                      </a>
                    </li>
                    <!-- <li class="<?php if($action == $url){ echo "active"; } ?>"><a href="<?php echo $child_url ?>"><i class="fa fa-circle-o"></i> <?php echo $name; ?></a></li> -->
                <?php 
                  }
                } 
                ?>
              </ul>
            </li>
          <?php
              }
            }
          ?>
          </li>
          <?php
          }//$menu foreach
          ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <?php if (!$this->ion_auth->is_admin()) { ?>
<div class="modal fade" tabindex="-1" role="dialog" id="updateimage_modal" aria-labelledby="updateimage">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?= lang('edit_user_modal_title'); ?></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <?php $attributes = array('id' => 'changeimage_form');
          echo form_open_multipart('' ,$attributes); ?>
        <div class="modal-body">
        <div class="msg">
        </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <h3><?=lang('edit_user_userimageupdate_label');?></h3>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="image">
                        <label class="custom-file-label" for="image"><?= lang('choose_file'); ?></label>
                    </div>
                </div>
              </div>
              <div style="margin-top: 20px; text-align: center;">
                <img id="image_preview" src="" style="max-width: 100%; height: auto;" />
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?=lang('edit_user_modal_cancel_btn_label');?></button>
          <button type="submit" name="uploadimage" class="btn btn-primary"><?=lang('edit_user_modal_submit_btn_label');?></button>
        </div>
      <?php echo form_close(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#image_preview').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#image").change(function(){
    readURL(this);
  });

  $('#changeimage_form').submit(function(event){  
    event.preventDefault();
    var userid = <?= $current_user->id; ?>;
    var data = new FormData();
    jQuery.each(jQuery('#image')[0].files, function(i, file) {
      data.append('userimageupdate', file);
    });
    jQuery.ajax({  
      url:"<?= base_url(); ?>admin/updateuserimage/"+userid,  
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      type: 'POST',
      success:function(data){
        var msg = '';
        if(data){
          if (data.status == 'success') {
            msg = '<div class="alert alert-success"><button href="#" class="close" data-dismiss="alert">&times;</button><?= lang('strong_success_label'); ?>'+ data.msg +'</div><br>';
          }else{
            msg = '<div class="alert alert-danger"><button href="#" class="close" data-dismiss="alert">&times;</button><?= lang('strong_error_label'); ?>'+ data.msg +'</div><br>';
          }   
        }
        $('.msg').html(msg);
        $('#updateimage_modal').animate({ scrollTop: 0 }, 'fast');
      }  
    });  
  });
</script>

<?php } ?>