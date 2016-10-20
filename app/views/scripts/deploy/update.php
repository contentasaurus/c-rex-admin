<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Deploy', 'url' => '/deploy'  ],
	[ 'name'=> 'Update', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		Update Datasource
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">

			<div class="form-group">
				<label>Name</label>
				<input placeholder="Name" class="form-control required" name="name" type="text" value="<?= $this->datasource['name'] ?>">
			</div>

			<input name="type" type="hidden" value="mysql">

			<div class="form-group">
				<label>DB Name</label>
				<input placeholder="atlantic_db" class="form-control required" name="dbname" type="text" value="<?= $this->datasource['dbname'] ?>">
			</div>

			<div class="form-group">
				<label>Host</label>
				<input placeholder="127.0.0.1" class="form-control required" name="host" type="text" value="<?= $this->datasource['host'] ?>">
			</div>

			<div class="form-group">
				<label>Port</label>
				<input placeholder="3306" class="form-control required" name="port" type="text" value="<?= $this->datasource['port'] ?>">
			</div>

			<div class="form-group">
				<label>Username</label>
				<input placeholder="AzureDiamond" class="form-control required" name="username" type="text" value="<?= $this->datasource['username'] ?>">
			</div>

			<div class="form-group">
				<label>Password</label>
				<input placeholder="hunter2" class="form-control required" name="password" type="password" value="<?= $this->datasource['password'] ?>">
			</div>

			<div class="form-group">
				<label>Description</label>
				<input class="form-control" name="description" type="text" value="<?= $this->datasource['description'] ?>">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Save</button>
				<a class="btn btn-secondary" href="/deploy">Cancel</a>
			</div>
		</form>
	</div>
</div>
