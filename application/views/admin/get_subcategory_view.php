<?php if (count($catList) > 0) {
    foreach ($catList as $cat) {
	?>
	<div><?= form_checkbox("category[".$parent_cat_id."][]", $cat->cat_id, FALSE, 'level="'.$cat_level.'"') . " " . $cat->cat_name ?></div>
    <?php }
}
?>