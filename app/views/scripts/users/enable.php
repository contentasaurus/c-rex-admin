<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Users', 'url' => '/users'  ],
	[ 'name'=> 'Enable User', 'active' => 'true'  ],
]]); ?>

<div class="container-fluid">
	<div class="col-lg-5">
		<div class="card card-outline-danger text-xs-center">
			<div class="card-header">Enable User</div>
			<div class="card-block">
				<div class="card-body">
					<blockquote class="card-blockquote">
						<form method="post" accept-charset="UTF-8">
							<input type="hidden" name="id" value="<?= $this->user['id'] ?>">

							<i class="fa fa-warning fa-2x"></i>
							<p>Are you sure you want to enable this user?</p>

							<button class="btn btn-primary" type="submit">Confirm Enable</button>
							<a class="btn btn-secondary" href="/users">Cancel</a>
						</form>
					</blockquote>
				</div>
			</div>
		</div>
	</div>
</div>
