<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Pages', 'url' => '/pages' ],
	[ 'name'=> 'Create Page', 'active' => 'true' ],
]]); ?>

<div class="card">
	<div class="card-header">
		Create Page
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label class="col-form-label">Permalink</label>
				<input placeholder="/my-permalink" class="form-control required" name="permalink" type="text">
			</div>

			<div class="form-group">
				<label class="col-form-label">Name</label>
				<input placeholder="Friendly name for your page" class="input-lg form-control required" name="name" type="text">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Next</button>
				<a class="btn btn-default" href="/pages">Cancel</a>
			</div>
		</form>
	</div>
</div>
