<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Datatypes', 'url' => '/datatypes'  ],
	[ 'name'=> 'Create Datatype', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		Create Datatype Template
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label>Name</label>
				<input placeholder="Name" class="form-control required" name="name" type="text">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Next</button>
				<a class="btn btn-secondary" href="/datatypes">Cancel</a>
			</div>
		</form>
	</div>
</div>
