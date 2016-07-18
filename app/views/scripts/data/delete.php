<ol class="breadcrumb">
  <li><a href="/data">Data</a></li>
  <li class="active">Delete Data</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-5">
		<section class="panel panel-danger">
			<header class="panel-heading">
				<h3 class="panel-title">Delete Data</h3>
			</header>
			<form method="post" accept-charset="UTF-8">
				<input type="hidden" name="id" value="<?= $this->data['id'] ?>">

				<div class="panel-body">
					<div align="center">
						<span class="material-icons md-72">delete_forever</span>
						<p>Are you sure you want to delete this data? This cannot be undone.</p>
					</div>
				</div>

				<footer class="panel-footer">
					<button class="btn btn-primary" type="submit">Confirm Delete</button>
					<a class="btn btn-default" href="/data">Cancel</a>	
				</footer>

			</form>

		</section>
	</div>
</div>
