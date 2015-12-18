<div class="row">
    <div class="clo-lg-12">
	<div class="alert alert-info"><i class="fa fa-info-circle"></i> Drag and Drop to change sorting order.</div>
	<?= form_hidden("pro_id", $pro_id) ?>
	<?php if (count($productImageList) > 0) { ?>
    	<ul id="sort_images">
		<?php foreach ($productImageList as $image_item) {
		    ?>
		    <li class="col-lg-3" image_id="<?= $image_item->pro_img_id ?>">
			<div class="panel panel-default imagebox_min_height">
			    <div class="panel-heading handle cursor_move">
				<?= ($image_item->caption != '' ? $image_item->caption : "&nbsp;") ?>
			    </div>
			    <div class="panel-body">
				<div class="pro-img-display"><img src="<?= $filepath . $image_item->image ?>" alt="something wrong" /></div>
				<div class="summary">
				    <p class="text-muted">Deleted: <span class="<?= ($image_item->is_deleted ? "red" : "") ?> deleted_status"><?= ($image_item->is_deleted ? "Yes" : "No") ?></span></p>
				    <p class="text-muted">Sort Order: <?= ($image_item->sort_order ? $image_item->sort_order : "-") ?></p>
				    <p pro_img_id="<?= $image_item->pro_img_id ?>">
					<a href="javascript:void(0);" class="edit_image_properties" data-target="#editImageProperties" data-toggle="modal"><i class="fa fa-edit" title="Edit"></i></a>&nbsp;<a href="javascript:void(0);" class="delImageConfirm" delete="<?= ($image_item->is_deleted ? "0" : "1")?>"><i class="fa <?= ($image_item->is_deleted ? "fa-repeat" : "fa-times") ?>" title="<?= ($image_item->is_deleted ? "Reset" : "Delete") ?>"></i></a>
				    </p>
				</div>
			    </div>
			</div>
		    </li>
		<?php }
		?>
    	</ul>
    	<!-- Modal -->
    	<div class="modal fade" id="editImageProperties" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	    <div class="modal-dialog">
    		<div class="modal-content">
    		    <div class="modal-header">
    			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    			<h4 class="modal-title" id="myModalLabel">Edit Image Properties</h4>
    		    </div>
    		    <div class="modal-body">
			
    		    </div>
    		    <div class="modal-footer">
    			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    			<button type="button" class="btn btn-primary" name="saveImageProperties" id="saveImageProperties">Save changes</button>
    		    </div>
    		</div>
    		<!-- /.modal-content -->
    	    </div>
    	    <!-- /.modal-dialog -->
    	</div>
	<?php } else {
	    ?>
    	<div class="alert alert-info">
    	    Be first to upload Image. Click <a href="<?= $this->config->item('base_url_admin') ?>products/singleUpload/<?= $pro_id ?>" class="alert-link">Upload Image</a>.
    	</div>
	<?php } ?>
    </div>
</div>