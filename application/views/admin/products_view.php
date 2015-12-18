<div class="row">
    <div class="col-lg-12">
	<?= form_open($this->config->item('base_url_admin') . "products/save") ?>
	<?= form_hidden("mode", $mode) ?>
	<?= form_hidden("pro_id", ($mode == "edit" ? $productDetail->pro_id : "")) ?>
	<div class="form-group">
	    <?= form_label('Product Name', '', array("class" => "control-label")) ?>
	    <?= form_input(array("name" => "pro_name", "id" => "pro_name", "maxlength" => "200", "class" => "form-control", "value" => ($mode == "edit" ? $productDetail->pro_name : ""))) ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label('Short Description', '', array("class" => "control-label")); ?>
	    <?= form_textarea(array("rows" => "3", "name" => "short_description", "id" => "short_description", "class" => "form-control", "value" => ($mode == "edit" ? $productDetail->short_description : ""))) ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label('Long Description'); ?>
	    <?= form_textarea(array("rows" => "7", "name" => "long_description", "id" => "long_description", "class" => "form-control", "value" => ($mode == "edit" ? $productDetail->long_description : ""))) ?>
	</div>
	<div class="form-group">
	    <?= form_label("Category") ?>
	    <?php
	    if (count($parentCategoryList) > 0) {
		foreach ($parentCategoryList as $cat) {
		    ?>
		    <div class="cat_main">
			<div><?= form_checkbox("category[" . $cat->cat_id . "]", $cat->cat_id, ($mode == "edit" && key_exists($cat->cat_id, $cat_ids_arr) ? TRUE : FALSE), 'class="cat_hierarchy" level="0"') . " " . $cat->cat_name ?></div>
			<?php if ($mode == "edit") { ?>
			    <?php
			    if (isset($cat->subcategory) && count($cat->subcategory) > 0) {
				foreach ($cat->subcategory as $subcat) {
				    ?>
		    		<div class="subcat_hierarchy" style="padding-left:20px;display:block"><div><?= form_checkbox("category[" . $cat->cat_id . "][]", $subcat->cat_id, ($mode == "edit" && is_array($cat_ids_arr[$cat->cat_id]) && in_array($subcat->cat_id, $cat_ids_arr[$cat->cat_id]) ? TRUE : FALSE), 'level="1"') . " " . $subcat->cat_name ?></div></div>
				    <?php
				}
			    }
			}
			?>
		    </div>
		    <?php
		}
	    }
	    ?>
	</div>
	<div class="form-group">
	    <?= form_label("Is Active") ?>
	    <?= form_dropdown("active", array("0" => "InActive", "1" => "Active"), ($mode == "edit" ? $productDetail->active : "1"), "class='form-control'"); ?>
	</div>
	<?= form_button(array("name" => "btn_product", "id" => "btn_product", "content" => "Save", "class" => "btn btn-primary", "type" => "submit")); ?>&nbsp;<?= form_button(array("type" => "reset", "class" => "btn btn-default", "content" => "Cancel", "onClick" => "javascript:history.go(-1)")) ?>
	<?= form_close() ?>
    </div>
</div>