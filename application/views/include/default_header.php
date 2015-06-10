<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Website resmi Penerimaan Peserta Didik Baru Kabupaten Sidoarjo">
		<meta name="author" content="Pemerintah Kabupaten Sidoarjo">
		<link rel="icon" href="<?php echo base_url(); ?>static/images/icon.ico">

		<title><?php echo $title; ?> - PPDB Sidoarjo 2015</title>

		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url(); ?>static/css/font.css" rel='stylesheet' type='text/css'>
		<link href="<?php echo base_url(); ?>static/css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/ppdb.css">
		<?php
			if (!empty($styles)) {
				foreach ($styles as $url) { ?>
					<link rel="stylesheet" type='text/css' href="<?php echo $url; ?>" />
				<?php }
			}
			if (!empty($header_scripts)) {
				foreach ($header_scripts as $url) { ?>
					<script type="text/javascript" src="<?php echo $url; ?>"></script>
				<?php }
			}
		?>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<img src="<?php echo base_url(); ?>static/images/logo_sda2.png" class="top_logo left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand left" href="<?php echo base_url(); ?>" style="font-weight: 300; font-size: 19px; position: relative; top: 10px; padding-left: 20px;"><span style="font-weight: 600;">PPDB</span> Sidoarjo 2015</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li class="active"><a href="<?php echo base_url(); ?>">HOME</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">INFO PENDAFTAR <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo base_url(); ?>informasi/jadwal_pelaksanaan">JADWAL PELAKSANAAN</a></li>
								<li><a href="<?php echo base_url(); ?>informasi/status_pendaftaran">STATUS PENDAFTARAN</a></li>
							</ul>
						</li>
					<!--	<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">HASIL SELEKSI <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo base_url(); ?>seleksi/siswa">PER SISWA</a></li>
								<li><a href="<?php echo base_url(); ?>seleksi/sekolah">PER SEKOLAH</a></li>
							</ul>
						</li> -->
						 <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">SEKOLAH <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo base_url(); ?>sekolah/smp">SMP</a></li>
								<li><a href="<?php echo base_url(); ?>sekolah/sma">SMA</a></li>
								<li><a href="<?php echo base_url(); ?>sekolah/smk">SMK</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">REKAPITULASI <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo base_url(); ?>rekapitulasi/2011">TAHUN 2011</a></li>
								<li><a href="<?php echo base_url(); ?>rekapitulasi/2012">TAHUN 2012</a></li>
								<li><a href="<?php echo base_url(); ?>rekapitulasi/2013">TAHUN 2013</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div id="wrapper">
			<div class="container">
