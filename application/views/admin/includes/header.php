<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?= $title ?></title>

	<!-- Bootstrap Core CSS -->
	<link href="<?= base_url() ?>css/admin/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="<?= base_url() ?>css/admin/metisMenu.min.css" rel="stylesheet">

	<!-- Timeline CSS -->
	<link href="<?= base_url() ?>css/admin/timeline.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="<?= base_url() ?>css/admin/sb-admin-2.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="<?= base_url() ?>css/admin/morris.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="<?= base_url() ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link href="<?= base_url() ?>css/admin/dataTables.bootstrap.css" rel="stylesheet">
	<link href="<?= base_url() ?>css/admin/dataTables.responsive.css" rel="stylesheet">
	<link href="<?= base_url() ?>css/admin/custom.css" rel="stylesheet">

    	<link rel="stylesheet" href="<?= base_url() ?>css/jquery-ui.css" type="text/css" />
	<?php if ($this->uri->segment(3) == 'multipleUpload') { ?>
    	<link rel="stylesheet" href="<?= base_url() ?>css/jquery.ui.plupload.css" type="text/css" />
	<?php } ?>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script type="text/javascript">
	    var base_url = "<?= $this->config->item('base_url_admin') ?>";
	    var base_url_front = "<?= $this->config->item('base_url') ?>";
	</script>
	<!-- jQuery -->
	<script src="<?= base_url() ?>js/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="<?= base_url() ?>js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="<?= base_url() ?>js/admin/metisMenu.min.js"></script>

	<!-- Morris Charts JavaScript -->
	<script src="<?= base_url() ?>js/admin/raphael-min.js"></script>
	<script src="<?= base_url() ?>js/admin/morris.min.js"></script>
	<script src="<?= base_url() ?>js/admin/morris-data.js"></script>
	<script src="<?= base_url() ?>js/admin/jquery.dataTables.min.js"></script>
	<script src="<?= base_url() ?>js/admin/dataTables.bootstrap.min.js"></script>

	<script type="text/javascript" src="<?= base_url() ?>js/jquery-ui.min.js"></script>
	<?php if ($this->uri->segment(3) == 'multipleUpload') { ?>
	<script type="text/javascript" src="<?= base_url() ?>js/plupload.full.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>js/jquery.ui.plupload.js"></script>
	<?php } ?>

	<!-- Custom Theme JavaScript -->
	<script src="<?= base_url() ?>js/admin/sb-admin-2.js"></script>
	<script src="<?= base_url() ?>js/admin/vart.js"></script>
	<script src="<?= base_url() ?>js/admin/validation.js"></script>
    </head>

    <body>

	<div id="wrapper">

	    <!-- Navigation -->
	    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		    </button>
		    <a class="navbar-brand" href="<?= $this->config->item("base_url_admin") ?>dashboard">V.Art Graphics Admin Area</a>
		</div>
		<!-- /.navbar-header -->

		<ul class="nav navbar-top-links navbar-right">
		    <!-- /.dropdown -->
		    <li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">
			    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">
			    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
			    </li>
			    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
			    </li>
			    <li class="divider"></li>
			    <li><a href="<?= $this->config->item('base_url_admin') . "auth/logout" ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
			    </li>
			</ul>
			<!-- /.dropdown-user -->
		    </li>
		    <!-- /.dropdown -->
		</ul>
		<!-- /.navbar-top-links -->

		<div class="navbar-default sidebar" role="navigation">
		    <div class="sidebar-nav navbar-collapse">
			<ul class="nav" id="side-menu">
			    <li class="sidebar-search">
				<div class="input-group custom-search-form">
				    <input type="text" class="form-control" placeholder="Search...">
				    <span class="input-group-btn">
					<button class="btn btn-default" type="button">
					    <i class="fa fa-search"></i>
					</button>
				    </span>
				</div>
				<!-- /input-group -->
			    </li>
			    <li>
				<a href="<?= $this->config->item("base_url_admin") ?>dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
			    </li>
			    <li>
				<a href="#"><i class="fa fa-sitemap fa-fw"></i> Category<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
				    <li>
					<a href="<?= $this->config->item("base_url_admin") ?>category">Category List</a>
				    </li>
				    <li>
					<a href="<?= $this->config->item("base_url_admin") ?>category/add">Add Category</a>
				    </li>
				</ul>
				<!-- /.nav-second-level -->
			    </li>
			    <li>
				<a href="#"><i class="fa fa-table fa-fw"></i> Products<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
				    <li>
					<a href="<?= $this->config->item("base_url_admin") ?>products">Product List</a>
				    </li>
				    <li>
					<a href="<?= $this->config->item("base_url_admin") ?>products/add">Add Product</a>
				    </li>
				    <li>
					<a href="<?= $this->config->item("base_url_admin") ?>products/images">Product Images</a>
				    </li>
				</ul>
			    </li>
			    <li>
				<a href="#"><i class="fa fa-files-o fa-fw"></i> Pages<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
				    <li>
					<a href="<?= $this->config->item("base_url_admin") ?>pages">Pages List</a>
				    </li>
				    <li>
					<a href="<?= $this->config->item("base_url_admin") ?>pages/add">Add Pages</a>
				    </li>
				</ul>
				<!-- /.nav-second-level -->
			    </li>
			    <li>
				<a href="#"><i class="fa fa-building fa-fw"></i> Banners<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
				    <li>
					<a href="<?= $this->config->item("base_url_admin") ?>banner">Banner List</a>
				    </li>
				    <li>
					<a href="<?= $this->config->item("base_url_admin") ?>banner/add">Add Banner</a>
				    </li>
				</ul>
			    </li>
			    <li>
				<a href="#"><i class="fa fa-trophy fa-fw"></i> Testimonial<span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
				    <li>
					<a href="<?= $this->config->item("base_url_admin") ?>testimonial">Testimonial List</a>
				    </li>
				    <li>
					<a href="<?= $this->config->item("base_url_admin") ?>testimonial/add">Add Testimonial</a>
				    </li>
				</ul>
			    </li>
			    <li>
				<a href="<?= $this->config->item("base_url_admin") ?>auth/change_password"><i class="fa fa-key fa-fw"></i> Change Password</a>
			    </li>
			    <li>
				<a href="<?= $this->config->item("base_url_admin") ?>auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
			    </li>
			</ul>
		    </div>
		    <!-- /.sidebar-collapse -->
		</div>
		<!-- /.navbar-static-side -->
	    </nav>
	    <div id="page-wrapper">
		<div class="row">
		    <div class="col-lg-12">
			<h1 class="page-header"><?= $head_page ?></h1>
		    </div>
		    <!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->