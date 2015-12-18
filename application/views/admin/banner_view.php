<div class="row">
    <div class="col-lg-12">
	<?= form_open_multipart($this->config->item('base_url_admin') . "banner/save") ?>
	<?= form_input(array("name" => "mode","id" => "mode", "value" => $mode, "type" => "hidden")) ?>
	<?= form_hidden("banner_id", ($mode == "edit" ? $bannerDetail->banner_id : "")) ?>
	<div class="form-group">
	    <?= form_label('Banner Name', '', array("class" => "control-label")) ?>
	    <?= form_input(array("name" => "name", "id" => "name", "maxlength" => "200", "class" => "form-control", "value" => ($mode == "edit" ? $bannerDetail->name : ""))) ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label('Banner Description'); ?>
	    <?= form_textarea(array("rows" => "3", "name" => "description", "id" => "description", "class" => "form-control", "value" => ($mode == "edit" ? $bannerDetail->description : ""))) ?>
	</div>
	<div class="form-group">
	    <?= form_label('Banner Image'); ?>
	    <?= form_upload(array("name" => "image", "id" => "image")) ?>
	    <p class="help-block"></p>
	    <?php if ($mode == 'edit') { ?>
    	    <img src="<?= ($bannerDetail->image != '' ? $this->config->item('base_url') . "images/home_banner/" . $bannerDetail->image : "") ?>" width="100" />
	    <?php } ?>
	</div>
	<div class="form-group">
	    <?= form_label("Is Active") ?>
	    <?= form_dropdown("active", array("0" => "InActive", "1" => "Active"), ($mode == "edit" ? $bannerDetail->active : "1"), "class='form-control'"); ?>
	</div>
	<?= form_button(array("name" => "btn_banner", "id" => "btn_banner", "content" => "Save", "class" => "btn btn-primary", "type" => "submit")); ?>&nbsp;<?= form_button(array("type" => "reset", "class" => "btn btn-default", "content" => "Cancel", "onClick" => "javascript:history.go(-1)")) ?>
	<?= form_close() ?>
    </div>
</div>