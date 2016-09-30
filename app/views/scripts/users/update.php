<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Users', 'url' => '/users'  ],
	[ 'name'=> 'Update User', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item pull-xs-left btn btn-link disabled">Update User</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/users/reset/<?= $this->user['id'] ?>"><i class="fa fa-envelope"></i> Reset Password</a>
			</li>
		</ul>
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">

			<input name="id" type="hidden" value="<?= $this->user['id'] ?>" >

			<div class="form-group">
				<label>Role</label>
				<select class="form-control required" name="role_id">
					<option value="">Select User Group</option>
					<?php foreach( $this->roles as $role ): ?>
					<option <?php if($this->user['role_id'] == $role['id']): ?>selected="selected"<?php endif; ?> value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label>First Name</label>
				<input placeholder="First Name" class="form-control required" name="first_name" type="text" value="<?= $this->user['first_name'] ?>" >
			</div>

			<div class="form-group">
				<label>Last Name</label>
				<input placeholder="Last Name" class="form-control required" name="last_name" type="text" value="<?= $this->user['last_name'] ?>" >
			</div>

			<div class="form-group">
				<label>Title</label>
				<input placeholder="Title" class="form-control" name="title" type="text" value="<?= $this->user['title'] ?>" >
			</div>

			<div class="form-group">
				<label>Email</label>
				<input placeholder="Email" class="form-control required" name="email" type="text" value="<?= $this->user['email'] ?>" >
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Save</button>
				<a class="btn btn-secondary" href="/users">Cancel</a>
			</div>
		</form>
	</div>
</div>
