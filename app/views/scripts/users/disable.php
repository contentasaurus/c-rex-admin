<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/users">Users</a></li>
	<li class="breadcrumb-item active">Disable User</li>
</ol>

<div class="container-fluid">
	<div class="col-lg-5">
		<div class="card card-outline-danger text-xs-center">
			<div class="card-header">Disable User</div>
			<div class="card-block">
				<div class="card-body">
					<blockquote class="card-blockquote">
						<form method="post" accept-charset="UTF-8">
							<input type="hidden" name="id" value="<?= $this->user['id'] ?>">

							<i class="fa fa-warning fa-2x"></i>
							<p>Are you sure you want to disable this user?</p>

							<button class="btn btn-primary" type="submit">Confirm Disable</button>
							<a class="btn btn-secondary" href="/users">Cancel</a>
						</form>
					</blockquote>
				</div>
			</div>
		</div>
	</div>
</div>
