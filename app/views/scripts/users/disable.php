<ol class="breadcrumb">
  <li><a href="/users">Users</a></li>
  <li class="active">Disable User</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-5">
		<section class="panel panel-danger">
			<header class="panel-heading">
				<h3 class="panel-title">Disable User</h3>
			</header>
			<form method="post" accept-charset="UTF-8">
				<input type="hidden" name="id" value="<?= $this->user['id'] ?>">

				<div class="panel-body">
					<div align="center">
						<span class="material-icons md-72">sentiment_very_dissatisfied</span>
						<p>Are you sure you want to disable this user?</p>
					</div>
				</div>

				<footer class="panel-footer">
					<div class="pull-right">
						<a class="btn btn-default" href="/users">Cancel</a>
						<button class="btn btn-primary" type="submit">Confirm Disable</button>
					</div>
				</footer>

			</form>

		</section>
	</div>
</div>
