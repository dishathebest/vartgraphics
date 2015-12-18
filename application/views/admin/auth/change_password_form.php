<?php
$data['title'] = "Change Password :: V.Art Graphics";
$data['head_page'] = "Change Password";
$this->load->view($this->config->item('admin_folder') . "includes/header", $data);
$old_password = array(
    'name' => 'old_password',
    'id' => 'old_password',
    'value' => set_value('old_password'),
    'size' => 30,
);
$new_password = array(
    'name' => 'new_password',
    'id' => 'new_password',
    'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    'size' => 30,
);
$confirm_new_password = array(
    'name' => 'confirm_new_password',
    'id' => 'confirm_new_password',
    'maxlength' => $this->config->item('password_max_length', 'tank_auth'),
    'size' => 30,
);
?>
<div class="row">
    <div class="col-lg-12">
	<?php if ($this->session->flashdata('message')) { ?>
    	<div class="alert alert-success alert-dismissable">
    	    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		<?= $this->session->flashdata('message') ?>
    	</div>
	<?php } ?>
	<?php echo form_open($this->config->item('base_url_admin') . "auth/change_password"); ?>
	<div class="form-group">
	    <?php echo form_label('Old Password', $old_password['id'], 'class="control-label"'); ?>
	    <?php echo form_password($old_password, "", 'class="form-control"') ?>
	    <p class="help-block"><?php echo form_error($old_password['name']); ?><?php echo isset($errors[$old_password['name']]) ? $errors[$old_password['name']] : ''; ?></p>
	</div>
	<div class="form-group">
	    <?php echo form_label('New Password', $new_password['id'], 'class="control-label"'); ?>
	    <?php echo form_password($new_password, "", 'class="form-control"'); ?>
	    <p class="help-block"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']]) ? $errors[$new_password['name']] : ''; ?></p>
	</div>
	<div class="form-group">
	    <?php echo form_label('Confirm New Password', $confirm_new_password['id'], 'class="control-label"'); ?>
	    <?php echo form_password($confirm_new_password, "", 'class="form-control"'); ?>
	    <p class="help-block"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']]) ? $errors[$confirm_new_password['name']] : ''; ?></p>
	</div>
	<?php echo form_submit('change', 'Change Password', 'class="btn btn-primary"'); ?>
	<?= form_close() ?>
    </div>
</div>
<?php $this->load->view($this->config->item('admin_folder') . "includes/footer"); ?>