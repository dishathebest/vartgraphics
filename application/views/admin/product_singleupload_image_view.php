<div class="row">
    <div class="col-lg-12">
	<?= form_open_multipart($this->config->item('base_url_admin') . "products/save_singleupload") ?>
	<?= form_hidden("mode", $mode) ?>
	<?= form_hidden("pro_id", $pro_id) ?>
	<div class="form-group">
	    <?= form_label('Upload Image', '', array("class" => "control-label")) ?>
	    <?= form_upload("image", "", 'id="image"') ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label('Caption', '', array("class" => "control-label")) ?>
	    <?= form_input(array("name" => "caption", "id" => "caption", "maxlength" => "200", "class" => "form-control", "value" => ($mode == "edit" ? $productImageDetail->caption : ""))) ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label('Short Description', '', array("class" => "control-label")); ?>
	    <?= form_textarea(array("rows" => "3", "name" => "short_description", "id" => "short_description", "class" => "form-control", "value" => ($mode == "edit" ? $productImageDetail->short_description : ""))) ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label('Long Description'); ?>
	    <?= form_textarea(array("rows" => "7", "name" => "long_description", "id" => "long_description", "class" => "form-control", "value" => ($mode == "edit" ? $productImageDetail->long_description : ""))) ?>
	</div>
	<?= form_button(array("name" => "btn_singleupload", "id" => "btn_singleupload", "content" => "Save", "class" => "btn btn-primary", "type" => "submit")); ?>&nbsp;<?= form_button(array("type" => "reset", "class" => "btn btn-default", "content" => "Cancel", "onClick" => "javascript:history.go(-1)")) ?>
	<?= form_close() ?>
    </div>
</div>