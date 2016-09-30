<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Components', 'url' => '/components'  ],
	[ 'name'=> 'Create Components', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		Create Component
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<input placeholder="Name" class="form-control required" name="name" type="text">
			</div>
			<div class="form-group">
				<textarea placeholder="Description" class="form-control" name="description"></textarea>
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Next</button>
				<a class="btn btn-default" href="/components">Cancel</a>
			</div>
		</form>
	</div>
</div>
