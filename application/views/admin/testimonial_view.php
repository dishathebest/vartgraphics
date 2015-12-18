<div class="row">
    <div class="col-lg-12">
	<?= form_open_multipart($this->config->item('base_url_admin') . "testimonial/save") ?>
	<?= form_input(array("name" => "mode","id" => "mode", "value" => $mode, "type" => "hidden")) ?>
	<?= form_hidden("testi_id", ($mode == "edit" ? $testimonialDetail->testi_id : "")) ?>
	<div class="form-group">
	    <?= form_label('Name', '', array("class" => "control-label")) ?>
	    <?= form_input(array("name" => "name", "id" => "name", "maxlength" => "200", "class" => "form-control", "value" => ($mode == "edit" ? $testimonialDetail->name : ""))) ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label('Company Name', '', array("class" => "control-label")) ?>
	    <?= form_input(array("name" => "company_name", "id" => "company_name", "maxlength" => "200", "class" => "form-control", "value" => ($mode == "edit" ? $testimonialDetail->company_name : ""))) ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label('Comment'); ?>
	    <?= form_textarea(array("rows" => "3", "name" => "comment", "id" => "comment", "class" => "form-control", "value" => ($mode == "edit" ? $testimonialDetail->comment : ""))) ?>
	</div>
	<div class="form-group">
	    <?= form_label('Image'); ?>
	    <?= form_upload(array("name" => "image", "id" => "image")) ?>
	    <p class="help-block"></p>
	    <?php if ($mode == 'edit') { ?>
    	    <img src="<?= ($testimonialDetail->image != '' ? $this->config->item('base_url') . "images/testimonial/" . $testimonialDetail->image : "") ?>" width="100" />
	    <?php } ?>
	</div>
	<div class="form-group">
	    <?= form_label("Is Active") ?>
	    <?= form_dropdown("active", array("0" => "InActive", "1" => "Active"), ($mode == "edit" ? $testimonialDetail->active : "1"), "class='form-control'"); ?>
	</div>
	<?= form_button(array("name" => "btn_testimonial", "id" => "btn_testimonial", "content" => "Save", "class" => "btn btn-primary", "type" => "submit")); ?>&nbsp;<?= form_button(array("type" => "reset", "class" => "btn btn-default", "content" => "Cancel", "onClick" => "javascript:history.go(-1)")) ?>
	<?= form_close() ?>
    </div>
</div>