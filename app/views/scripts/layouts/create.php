<?php use \puffin\transformer as transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Layouts', 'url' => '/layouts'  ],
	[ 'name'=> 'Create Layout', 'active' => 'true'  ],
]]); ?>



<div class="container-fluid">
	<div class="col-lg-10">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label>Name</label>
				<input placeholder="Name" class="form-control required input-lg" name="name" type="text" value="">
			</div>
			<div class="form-group">
				<label>Description</label>
				<textarea placeholder="Description" rows="4" class="form-control" name="description"></textarea>
			</div>

			<br />
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="submit" class="btn btn-primary navbar-btn">Next</button>
						<a class="btn btn-default navbar-btn" href="/layouts">Cancel</a>
					</div>
				</div>
			</nav>
		</form>
	</div>
</div>
