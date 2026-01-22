<section class="content">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <p><?php echo lang('edit_user_subheading');?></p>
    </div>
    <?php echo form_open(uri_string());?>
    <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <p>
              <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
              <?php echo form_input($first_name);?>
            </p>

            <p>
              <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
              <?php echo form_input($last_name);?>
            </p>

            <p>
              <?php echo lang('edit_user_company_label', 'company');?> <br />
              <?php echo form_input($company);?>
            </p>
          </div>
          <div class="col-md-4">
            <p>
              <?php echo lang('edit_user_phone_label', 'phone');?> <br />
              <?php echo form_input($phone);?>
            </p>
            <p>
              <?php echo lang('edit_user_password_label', 'password');?> <br />
              <?php echo form_input($password);?>
            </p>
            <p>
              <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
              <?php echo form_input($password_confirm);?>
            </p>
          </div>
          <div class="col-md-4">
            <h3><?php echo lang('edit_user_groups_heading');?></h3>
              <?php foreach ($groups as $group):?>
                <label class="radio">
                  <?php
                    $gID=$group['id'];
                    $checked = null;
                    $item = null;
                    foreach($currentGroups as $grp) {
                        if ($gID == $grp->id) {
                            $checked= ' checked="checked"';
                        break;
                        }
                    }
                  ?>
                <input type="radio" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                <?php echo htmlspecialchars($group['description'],ENT_QUOTES,'UTF-8');?>
                </label>
                <br>
              <?php endforeach?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div>
              <h3><?=lang('create_user_accessibleAccounts_label');?></h3>
              <select class="form-control" name="accounts[]" id="accessibleAccounts" multiple required>
                <option value="all" <?= ($user->all_accounts == 1 && $accessibleAccounts[0] == 'all') ? 'selected="selected"' : '';?> ><?=lang('create_user_accessibleAccounts_frst_option');?></option>
              <?php 
              foreach ($accounts as $row => $account){
                $selected = '';
                foreach ($accessibleAccounts as $selected_accounts) {
                  if ($selected_accounts == $account->id) {
                    $selected = 'selected="selected"';
                  }
                }
              ?>
                <option value="<?= $account->id; ?>" <?= (!empty($selected) ? $selected : ''); ?> ><?= ($account->label); ?></option>
              <?php }?>
            </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group" style="margin-top: 30px;">
              <button type="button" class="btn btn-info btn-lg" id="userimageuploadbtn" style="width: 100%;"><?=lang('edit_user_updateuserimage_btn_label');?></button>
            </div>
          </div>
        </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary float-right"><?=lang('edit_user_submit_btn');?></button>
      <a href="<?= base_url(); ?>admin/users/" id="cancel" name="cancel" class="btn btn-danger float-right" style="margin-right: 5px;"><?=lang('edit_user_cancel_btn');?></a>
    </div>
    <?php echo form_close();?>

  </div>
</section>

<div class="modal fade" role="dialog" id="userimage">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?= lang('edit_user_modal_title'); ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <?php $attributes = array('id' => 'updateuserimage');
          echo form_open_multipart('' ,$attributes); ?>
        <div class="modal-body">
        <div class="msg">
        </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <label for="userimageupdate"><?=lang('edit_user_userimageupdate_label');?></label>
                  <div class="input-group">
                      <div class="custom-file">
                          <input type="file" name="userimageupdate" class="custom-file-input" id="userimageupdate">
                          <label class="custom-file-label" for="userimageupdate"><?= lang('choose_file'); ?></label>
                      </div>
                  </div>
              </div>
              <!-- <div style="margin-left: 20px;">
                <label><?=lang('edit_user_userimageupdate_label');?></label>
                <input type="file" name="userimageupdate" id="userimageupdate" />
              </div> -->
              <div style="margin-top: 20px; text-align: center;">
                <img id="previewImage" src="" style="max-width: 100%; height: auto;" />
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger float-right" data-dismiss="modal"><?=lang('edit_user_modal_cancel_btn_label');?></button>
          <button type="submit" name="uploadimage" class="btn btn-primary float-right"><?=lang('edit_user_modal_submit_btn_label');?></button>
        </div>
      <?php echo form_close(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
  $(document).on('click', '#userimageuploadbtn', function() {
    $('#userimage').modal('show');
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#previewImage').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $('#accessibleAccounts').select2({
    placeholder: "<?=lang('create_user_accessibleAccounts_placeholder');?>"
  });

$("#userimageupdate").change(function(){
  readURL(this);
});

$('#updateuserimage').submit(function(event){  
  event.preventDefault();
  var userid = <?= $user->id; ?>;
  var data = new FormData();
  jQuery.each(jQuery('#userimageupdate')[0].files, function(i, file) {
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
      var alert = '';
      if(data){
        if (data.status == 'success') {
          alert = '<div class="alert alert-success"><button href="#" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button><?= lang('strong_success_label'); ?><br>'+ data.msg +'</div>';
        }else{
          alert = '<div class="alert alert-danger"><button href="#" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button><?= lang('strong_error_label'); ?><br>'+ data.msg +'</div><br>';
        }      
      }
      $('.msg').html(alert);
      $('#userimage').animate({ scrollTop: 0 }, 'fast');
    }  
  });  
});
</script>