<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="/pages">Pages</a></li>
  <li class="breadcrumb-item active">Delete Page</li>
</ol>

<div class="container-fluid">
	<div class="col-lg-5">
		<div class="card card-outline-danger text-xs-center">
			<div class="card-header">Delete Page</div>
			<div class="card-block">
				<div class="card-body">
					<blockquote class="card-blockquote">
						<form method="post" accept-charset="UTF-8">
							<input type="hidden" name="id" value="<?= $this->page['id'] ?>">

							<i class="fa fa-trash-o fa-2x"></i>
							<p>Are you sure you want to delete this page? This cannot be undone.</p>

							<button class="btn btn-primary" type="submit">Confirm Delete</button>
							<a class="btn btn-secondary" href="/pages">Cancel</a>
						</form>
					</blockquote>
				</div>
			</div>
		</div>
	</div>
</div>
