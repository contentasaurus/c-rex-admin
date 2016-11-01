<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="apple-touch-icon" sizes="57x57" href="/theme/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/theme/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/theme/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/theme/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/theme/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/theme/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/theme/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/theme/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/theme/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/theme/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/theme/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/theme/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/theme/favicon/favicon-16x16.png">
		<link rel="manifest" href="/theme/favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/theme/favicon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">

		<title><?php echo $this->TITLE ?></title>
		<?php echo $this->META ?>
		<?php echo $this->CSS ?>
		<?php echo $this->JS ?>
	</head>
	<body id="body">
		<?php echo $this->partial('sidenav') ?>
		<section id="content">
			<?php echo $this->partial('messages') ?>
			<?php echo $this->CONTENTS ?>
		</section>
		<?php echo $this->NONBLOCKING_JS ?>
		<script>
			$(function(){
				$(".alert").alert();
			});
		</script>
	</body>
</html>
