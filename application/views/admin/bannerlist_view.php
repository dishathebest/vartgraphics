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
				<th>Banner</th>
				<th>Image</th>
				<th>Active</th>
				<th>Edit/Delete</th>
			    </tr>
			</thead>
			<?php if (count($bannerList) > 0) { ?>
    			<tbody>
				<?php foreach ($bannerList as $index => $banner) { ?>
				    <tr>
					<td><?= $banner->name ?></td>
					<td align="center"><img src="<?= ($banner->image != '' ? $this->config->item('base_url') . "images/home_banner/".$banner->image : "") ?>" width="100" /></td>
					<td align="center"><a href="javascript:void(0);" entity="banner" contrlr="banner" banner-active="<?= $banner->active ?>" banner-id="<?= $banner->banner_id ?>" class="btn_active btn_activeEntity btn btn-<?= ($banner->active ? 'success' : "danger") ?>"><?= ($banner->active ? "Active" : "InActive") ?></a></td>
					<td align="center">
					    <a title="Edit" href="<?= $this->config->item('base_url_admin') ?>banner/edit/<?= $banner->banner_id ?>"><i class="fa fa-edit fa-2x green"></i></a> <a title="Delete" href="javascript:void(0)" onclick="deleteConfirm('Banner', 'banner', '<?= $banner->banner_id ?>')"><i class="fa fa-times-circle fa-2x red"></i></a></td>
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