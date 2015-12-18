<div class="row">
    <div class="col-lg-3 col-md-6">
	<div class="panel panel-primary">
	    <div class="panel-heading">
		<div class="row">
		    <div class="col-xs-3">
			<i class="fa fa-sitemap fa-5x"></i>
		    </div>
		    <div class="col-xs-9 text-right">
			<div class="huge"><?= count($categories) ?></div>
			<div>Categories</div>
		    </div>
		</div>
	    </div>
	    <a href="<?= $this->config->item("base_url_admin") ?>category">
		<div class="panel-footer">
		    <span class="pull-left">View Details</span>
		    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		    <div class="clearfix"></div>
		</div>
	    </a>
	</div>
    </div>
    <div class="col-lg-3 col-md-6">
	<div class="panel panel-green">
	    <div class="panel-heading">
		<div class="row">
		    <div class="col-xs-3">
			<i class="fa fa-table fa-5x"></i>
		    </div>
		    <div class="col-xs-9 text-right">
			<div class="huge"><?= count($products) ?></div>
			<div>Products</div>
		    </div>
		</div>
	    </div>
	    <a href="<?= $this->config->item("base_url_admin") ?>products">
		<div class="panel-footer">
		    <span class="pull-left">View Details</span>
		    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		    <div class="clearfix"></div>
		</div>
	    </a>
	</div>
    </div>
    <div class="col-lg-3 col-md-6">
	<div class="panel panel-yellow">
	    <div class="panel-heading">
		<div class="row">
		    <div class="col-xs-3">
			<i class="fa fa-files-o fa-5x"></i>
		    </div>
		    <div class="col-xs-9 text-right">
			<div class="huge"><?= count($pages) ?></div>
			<div>Pages</div>
		    </div>
		</div>
	    </div>
	    <a href="<?= $this->config->item("base_url_admin") ?>pages">
		<div class="panel-footer">
		    <span class="pull-left">View Details</span>
		    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		    <div class="clearfix"></div>
		</div>
	    </a>
	</div>
    </div>
    <div class="col-lg-3 col-md-6">
	<div class="panel panel-red">
	    <div class="panel-heading">
		<div class="row">
		    <div class="col-xs-3">
			<i class="fa fa-building fa-5x"></i>
		    </div>
		    <div class="col-xs-9 text-right">
			<div class="huge"><?= count($banners) ?></div>
			<div>Banners</div>
		    </div>
		</div>
	    </div>
	    <a href="<?= $this->config->item("base_url_admin") ?>banner">
		<div class="panel-footer">
		    <span class="pull-left">View Details</span>
		    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
		    <div class="clearfix"></div>
		</div>
	    </a>
	</div>
    </div>
</div>
<!-- /.row -->
<div class="row">
    
</div>
<!-- /.row -->
