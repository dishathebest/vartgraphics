<div class="row">
    <div class="col-lg-12">
    <?= form_open_multipart($this->config->item('base_url_admin') . "category/save") ?>
	<?= form_hidden("mode", $mode) ?>
	<?= form_hidden("cat_id", ($mode == "edit" ? $categoryDetail->cat_id : "")) ?>
	<div class="form-group">
	    <?= form_label('Category Name', '', array("class" => "control-label")) ?>
	    <?= form_input(array("name" => "cat_name", "id" => "cat_name", "maxlength" => "200", "class" => "form-control","value"=>($mode == "edit" ? $categoryDetail->cat_name : ""))) ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label('Category Description'); ?>
	    <?= form_textarea(array("rows" => "3", "name" => "cat_description", "id" => "cat_description", "class" => "form-control","value"=>($mode == "edit" ? $categoryDetail->cat_description : ""))) ?>
	</div>
	<div class="form-group">
	    <?= form_label("Parent Category") ?>
	    <?= form_dropdown("cat_parent_id", $parentCategoryList, ($mode == "edit" ? $categoryDetail->cat_parent_id : ""), "class='form-control'"); ?>
	</div>
    <div class="form-group">
	    <?= form_label('Image'); ?>
	    <?= form_upload(array("name" => "image_home", "id" => "image_home")) ?>
	    <p class="help-block"></p>
	    <?php if ($mode == 'edit' && $categoryDetail->image_home != '') { ?>
    	    <img src="<?= ($categoryDetail->image_home != '' ? $this->config->item('base_url') . "images/home_category/" . $categoryDetail->image_home : "") ?>" width="100" />
	    <?php } ?>
	</div>
	<div class="form-group">
	    <?= form_label("Is Active") ?>
	    <?= form_dropdown("active", array("0"=>"InActive","1"=>"Active"), ($mode == "edit" ? $categoryDetail->active : "1"), "class='form-control'"); ?>
	</div>
	<?= form_button(array("name" => "btn_category", "id" => "btn_category", "content" => "Save", "class" => "btn btn-primary", "type" => "submit")); ?>&nbsp;<?= form_button(array("type" => "reset", "class" => "btn btn-default", "content" => "Cancel","onClick"=>"javascript:history.go(-1)")) ?>
	<?= form_close() ?>
    </div>
</div>