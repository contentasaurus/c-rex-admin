<ol class="breadcrumb">
  <li><a href="/users">Users</a></li>
  <li class="active">Update User</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<section class="panel panel-default">
			<header class="panel-heading">
				<h3 class="panel-title">Update User</h3>
			</header>
			<form method="post" action="/users/create" accept-charset="UTF-8" data-form-ajax="">

				<input name="id" type="hidden" value="<?= $this->user['id'] ?>" >

				<div class="panel-body">

					<div class="form-group">
						<select class="form-control required" name="role_id">
							<option value="">Select User Group</option>
							<?php foreach( $this->roles as $role ): ?>
							<option <?php if($this->user['role_id'] == $role['id']): ?>selected="selected"<?php endif; ?> value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<input placeholder="First Name" class="form-control required" name="first_name" type="text" value="<?= $this->user['first_name'] ?>" >
					</div>

					<div class="form-group">
						<input placeholder="Last Name" class="form-control required" name="last_name" type="text" value="<?= $this->user['last_name'] ?>" >
					</div>

					<div class="form-group">
						<input placeholder="Title" class="form-control" name="title" type="text" value="<?= $this->user['title'] ?>" >
					</div>

					<div class="form-group">
						<input placeholder="Email" class="form-control required" name="email" type="text" value="<?= $this->user['email'] ?>" >
					</div>

					<div class="form-group">
						<a class="btn btn-default"><span class="icon-email"></span> Reset Password</a>
					</div>

				</div>

				<footer class="panel-footer">
					<div class="pull-right">
						<a class="btn btn-default" href="/users">Cancel</a>
						<button class="btn btn-primary" type="submit">Update</button>
					</div>
				</footer>

			</form>

		</section>
	</div>
</div>
