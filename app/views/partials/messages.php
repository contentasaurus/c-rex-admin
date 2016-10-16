<?php

use \puffin\message as message;

$messages = message::get(); 
?>

<?php foreach( $messages as $message ): ?>
	<?php extract($message) ?>
	<div class="alert alert-<?= $class ?> alert-dismissible fade in" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		<strong><?= $title ?></strong> <?= $message ?>
	</div>
<?php endforeach; ?>

<?php message::clear(); ?>
