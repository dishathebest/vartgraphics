<div class="row">
    <div class="col-lg-12">
	<div class="panel panel-default">

	    <!-- /.panel-heading -->
	    <div class="panel-body">
		<?php if (isset($msg)) { ?>
    		<div class="alert alert-<?= $msg_type ?> alert-dismissable">
    		    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    		    <?= $msg ?>
    		</div>
		<?php } ?>
		<div class="dataTable_wrapper">
		    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			<thead>
			    <tr>
				<th>Name</th>
				<th>Company Name</th>
				<th>Image</th>
				<th>Active</th>
				<th>Edit/Delete</th>
			    </tr>
			</thead>
			<?php if (count($testimonialList) > 0) { ?>
    			<tbody>
				<?php foreach ($testimonialList as $index => $testimonial) { ?>
				    <tr>
					<td><?= $testimonial->name ?></td>
					<td><?= $testimonial->company_name ?></td>
					<td align="center"><?php if($testimonial->image != '') { ?><img src="<?= ($testimonial->image != '' ? $this->config->item('base_url') . "images/testimonial/".$testimonial->image : "") ?>" width="100" /><?php } ?></td>
					<td align="center"><a href="javascript:void(0);" entity="testimonial" contrlr="testimonial" testimonial-active="<?= $testimonial->active ?>" testimonial-id="<?= $testimonial->testi_id ?>" class="btn_active btn_activeEntity btn btn-<?= ($testimonial->active ? 'success' : "danger") ?>"><?= ($testimonial->active ? "Active" : "InActive") ?></a></td>
					<td align="center">
					    <a title="Edit" href="<?= $this->config->item('base_url_admin') ?>testimonial/edit/<?= $testimonial->testi_id ?>"><i class="fa fa-edit fa-2x green"></i></a> <a title="Delete" href="javascript:void(0)" onclick="deleteConfirm('Testimonial', 'testimonial', '<?= $testimonial->testi_id ?>')"><i class="fa fa-times-circle fa-2x red"></i></a></td>
				    </tr>
				<?php } ?>
    			</tbody>
			<?php } ?>

		    </table>
		</div>
		<!-- /.table-responsive -->
	    </div>
	    <!-- /.panel-body -->
	</div>
	<!-- /.panel -->
    </div>
</div>