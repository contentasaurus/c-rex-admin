<?php
	$url = $this->url;
	$id = $this->id;
?>

<button type="button" class="btn btn-danger btn-sm" data-toggle="popover" data-placement="left" data-trigger="focus" data-html="true" data-content='
	<form method="post" action="<?= $url ?>">
		<input type="hidden" name="id" value="<?= $id ?>">
		<button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Confirm Delete</button>
	</form>'>
	<i class="fa fa-times"></i>
</button>
