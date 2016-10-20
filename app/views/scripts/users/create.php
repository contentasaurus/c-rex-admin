<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Users', 'url' => '/users'  ],
	[ 'name'=> 'Create User', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">Create User</div>
	<div class="card-block">
		<form method="POST" action="/users/create" accept-charset="UTF-8" data-form-ajax="">

			<div class="form-group">
				<label>Administrator?</label>
				<select class="form-control required" name="is_admin">
					<?php if( permissions::is_owner() ): ?>
						<option value="2" selected="selected">Super Admin!</option>
					<?php endif; ?>
					<option value="1" selected="selected">Yes</option>
					<option value="0" selected="selected">No</option>
				</select>
			</div>

			<div class="form-group">
				<label>First Name</label>
				<input placeholder="First Name" class="form-control required" name="first_name" type="text">
			</div>

			<div class="form-group">
				<label>Last Name</label>
				<input placeholder="Last Name" class="form-control required" name="last_name" type="text">
			</div>

			<div class="form-group">
				<label>Title</label>
				<input placeholder="Title" class="form-control" name="title" type="text">
			</div>

			<div class="form-group">
				<label>Email</label>
				<input placeholder="Email" class="form-control required" name="email" type="text">
			</div>
			<br />
			<div class="form-group">
				<label>Password</label>
				<input placeholder="Password" class="form-control required" name="password" type="password" value="">
			</div>

			<div class="form-group">
				<label>Confirm Password</label>
				<input placeholder="Confirm Password" class="form-control required" name="confirm_password" type="password" value="">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Create</button>
				<a class="btn btn-secondary" href="/users">Cancel</a>
			</div>
		</form>
	</div>
</div>
