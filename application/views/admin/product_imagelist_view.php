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
				<th>Product</th>
				<th>Single Upload</th>
				<th>Multiple Upload</th>
				<th>Total</th>
				<th>View</th>
				<th>Edit</th>
				<th>Delete All</th>
			    </tr>
			</thead>
			<?php if (count($productList) > 0) { ?>
    			<tbody>
				<?php foreach ($productList as $index => $product) { ?>
				    <tr>
					<td><?= $product->pro_name ?></td>
					<td align="center"><a href="<?= $this->config->item('base_url_admin') ?>products/singleUpload/<?= $product->pro_id ?>" class="btn_active btn btn-success">Upload</a></td>
					<td align="center"><a href="<?= $this->config->item('base_url_admin') ?>products/multipleUpload/<?= $product->pro_id ?>" class="btn_active btn btn-success">Upload</a></td>
					<td align="center"><?= $product->total ?></td>
					<td align="center"><a title="View" href="<?= $this->config->item('base_url_admin') ?>products/imageview/<?= $product->pro_id ?>"><i class="fa fa-eye fa-2x green"></i></a></td>
					<td align="center"><a title="Edit" href="<?= $this->config->item('base_url_admin') ?>products/edit/<?= $product->pro_id ?>"><i class="fa fa-edit fa-2x green"></i></a></td>
					<td align="center"><a title="Delete" href="javascript:void(0)" onclick="deleteConfirmImage('<?= $product->pro_id ?>')"><i class="fa fa-times-circle fa-2x red"></i></a></td>
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