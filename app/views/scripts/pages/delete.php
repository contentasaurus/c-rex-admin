<ol class="breadcrumb">
  <li><a href="/pages">Pages</a></li>
  <li class="active">Delete Page</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-5">
		<section class="panel panel-danger">
			<header class="panel-heading">
				<h3 class="panel-title">Delete Page</h3>
			</header>
			<form method="post" accept-charset="UTF-8">
				<input type="hidden" name="id" value="<?= $this->page['id'] ?>">

				<div class="panel-body">
					<div align="center">
						<span class="material-icons md-72">delete_forever</span>
						<p>Are you sure you want to delete this page? This cannot be undone.</p>
					</div>
				</div>

				<footer class="panel-footer">
					<button class="btn btn-primary" type="submit">Confirm Delete</button>
					<a class="btn btn-default" href="/pages">Cancel</a>
				</footer>

			</form>

		</section>
	</div>
</div>
