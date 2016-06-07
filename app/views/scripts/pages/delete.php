<ol class="breadcrumb">
  <li><a href="/blocks">Blocks</a></li>
  <li class="active">Delete Block</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-5">
		<section class="panel panel-danger">
			<header class="panel-heading">
				<h3 class="panel-title">Delete Block</h3>
			</header>
			<form method="post" accept-charset="UTF-8">
				<input type="hidden" name="id" value="<?= $this->block['id'] ?>">

				<div class="panel-body">
					<div align="center">
						<span class="material-icons md-72">delete_forever</span>
						<p>Are you sure you want to delete this block? This cannot be undone.</p>
					</div>
				</div>

				<footer class="panel-footer">
					<div class="pull-right">
						<a class="btn btn-default" href="/blocks">Cancel</a>
						<button class="btn btn-primary" type="submit">Confirm Delete</button>
					</div>
				</footer>

			</form>

		</section>
	</div>
</div>
