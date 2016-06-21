<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php echo $this->TITLE ?></title>
		<?php echo $this->META ?>
		<?php echo $this->CSS ?>
		<?php echo $this->JS ?>
	</head>
	<body id="body">
		<?php echo $this->partial('sidenav') ?>
		<section id="content">
			<?php echo $this->CONTENTS ?>
		</section>
		<?php echo $this->NONBLOCKING_JS ?>
	</body>
</html>
