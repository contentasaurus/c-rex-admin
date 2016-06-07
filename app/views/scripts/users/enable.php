<ol class="breadcrumb">
  <li><a href="/users">Users</a></li>
  <li class="active">Enable User</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-5">
		<section class="panel panel-info">
			<header class="panel-heading">
				<h3 class="panel-title">Enable User</h3>
			</header>
			<form method="post" accept-charset="UTF-8">
				<input type="hidden" name="id" value="<?= $this->user['id'] ?>">

				<div class="panel-body">
					<div align="center">
						<span class="material-icons md-72">sentiment_very_satisfied</span>
						<p>Are you sure you want to enable this user?</p>
					</div>
				</div>

				<footer class="panel-footer">
					<div class="pull-right">
						<a class="btn btn-default" href="/users">Cancel</a>
						<button class="btn btn-primary" type="submit">Confirm Enable</button>
					</div>
				</footer>

			</form>

		</section>
	</div>
</div>
