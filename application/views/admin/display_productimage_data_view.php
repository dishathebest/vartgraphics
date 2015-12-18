<div class="form-group">
    <?= form_label('Caption', '', array("class" => "control-label")) ?>
    <?= form_input(array("name" => "caption", "id" => "caption", "maxlength" => "200", "class" => "form-control", "value" => $productImageDetail->caption)) ?>
    <p class="help-block"></p>
</div>
<div class="form-group">
    <?= form_label('Short Description', '', array("class" => "control-label")); ?>
    <?= form_textarea(array("rows" => "3", "name" => "short_description", "id" => "short_description", "class" => "form-control", "value" => $productImageDetail->short_description)) ?>
    <p class="help-block"></p>
</div>
<div class="form-group">
    <?= form_label('Long Description'); ?>
    <?= form_textarea(array("rows" => "7", "name" => "long_description", "id" => "long_description", "class" => "form-control", "value" => $productImageDetail->long_description)) ?>
</div>
<?= form_input(array("name" => "pro_img_id", "id" => "pro_img_id", "type" => "hidden", "value" => $productImageDetail->pro_img_id)) ?>