<!--<script type="text/javascript" src="<?= base_url('js/ckeditor.js') ?>"></script>-->
<div class="row">
    <div class="col-lg-12">
	<?= form_open($this->config->item('base_url_admin') . "pages/save") ?>
	<?= form_hidden("mode", $mode) ?>
	<?= form_hidden("page_id", ($mode == "edit" ? $pageDetail->page_id : "")) ?>
	<div class="form-group">
	    <?= form_label('Page Name', '', array("class" => "control-label")) ?>
	    <?= form_input(array("name" => "page_name", "id" => "page_name", "maxlength" => "200", "class" => "form-control", "value" => ($mode == "edit" ? $pageDetail->page_name : ""))) ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label('Page Title', '', array("class" => "control-label")) ?>
	    <?= form_input(array("name" => "page_title", "id" => "page_title", "maxlength" => "200", "class" => "form-control", "value" => ($mode == "edit" ? $pageDetail->page_title : ""))) ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label('Page URL', '', array("class" => "control-label")) ?>
	    <?= form_input(array("name" => "page_url", "id" => "page_url", "maxlength" => "200", "class" => "form-control", "value" => ($mode == "edit" ? $pageDetail->page_url : ""))) ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label('Page Content', '', array("class" => "control-label")) ?>
	    <?php echo $this->ckeditor->editor('content',($mode == "edit" ? $pageDetail->content : "")) ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label('Meta Keyword', '', array("class" => "control-label")); ?>
	    <?= form_textarea(array("rows" => "3", "name" => "meta_keyword", "id" => "meta_keyword", "class" => "form-control", "value" => ($mode == "edit" ? $pageDetail->meta_keyword : ""))) ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label('Meta Description', '', array("class" => "control-label")); ?>
	    <?= form_textarea(array("rows" => "3", "name" => "meta_description", "id" => "meta_description", "class" => "form-control", "value" => ($mode == "edit" ? $pageDetail->meta_description : ""))) ?>
	    <p class="help-block"></p>
	</div>
	<div class="form-group">
	    <?= form_label("Is Active") ?>
	    <?= form_dropdown("active", array("0" => "InActive", "1" => "Active"), ($mode == "edit" ? $pageDetail->active : "1"), "class='form-control'"); ?>
	</div>
	<?= form_button(array("name" => "btn_page", "id" => "btn_page", "content" => "Save", "class" => "btn btn-primary", "type" => "submit")); ?>&nbsp;<?= form_button(array("type" => "reset", "class" => "btn btn-default", "content" => "Cancel", "onClick" => "javascript:history.go(-1)")) ?>
	<?= form_close() ?>
    </div>
</div>