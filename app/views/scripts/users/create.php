<h1><span class="icon-people"></span> Create User</h1>

<div class="container-fluid">
	<div class="col-lg-10">
		<section class="panel panel-default">
			<header class="panel-heading">
				Please complete the form. To go back to the previous page, hit Cancel.
			</header>
			<form method="POST" action="/users/create" accept-charset="UTF-8" data-form-ajax="">
				<div class="panel-body">

					<div class="form-group">
						<select class="form-control required" name="role_id">
							<option value="" selected="selected">Select User Group</option>
							<?php foreach( $this->roles as $role ): ?>
							<option value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<label for="photo">Photo</label>
						<input name="photo" type="file" id="photo">
					</div>

					<div class="form-group">
						<input placeholder="First Name" class="form-control required" name="first_name" type="text">
					</div>

					<div class="form-group">
						<input placeholder="Last Name" class="form-control required" name="last_name" type="text">
					</div>

					<div class="form-group">
						<input placeholder="Title" class="form-control" name="title" type="text">
					</div>

					<div class="form-group">
						<input placeholder="Email" class="form-control required" name="email" type="text">
					</div>

					<div class="form-group">
						<input placeholder="Password" class="form-control required" name="password" type="password" value="">
					</div>

					<div class="form-group">
						<input placeholder="Confirm Password" class="form-control required" name="confirm_password" type="password" value="">
					</div>

				</div>

				<footer class="panel-footer">
					<div class="pull-right">
						<a class="btn" href="/users">Cancel</a>
						<button class="btn btn-primary" type="submit">Add</button>
					</div>
				</footer>

			</form>

		</section>
	</div>
</div>
