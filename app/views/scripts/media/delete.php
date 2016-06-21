<ol class="breadcrumb">
  <li><a href="/media">Media</a></li>
  <li class="active">Delete Image</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-5">
		<section class="panel panel-danger">
			<header class="panel-heading">
				<h3 class="panel-title">Delete Image</h3>
			</header>
			<form method="post" accept-charset="UTF-8">
				<input type="hidden" name="id" value="<?= $this->media['id'] ?>">

				<div class="panel-body">
					<div align="center">
						<div>
							<img class="img-thumbnail" src="<?= $this->media['thumbnail_path'] ?>">
						</div>
						<span class="material-icons md-72">delete_forever</span>
						<p>Are you sure you want to delete this image? This cannot be undone.</p>
					</div>
				</div>

				<footer class="panel-footer">
					<div class="pull-right">
						<a class="btn btn-default" href="/media">Cancel</a>
						<button class="btn btn-primary" type="submit">Confirm Delete</button>
					</div>
				</footer>

			</form>

		</section>
	</div>
</div>
