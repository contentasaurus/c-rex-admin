<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/components">Components</a></li>
	<li class="breadcrumb-item active">Delete Component</li>
</ol>

<div class="container-fluid">
	<div class="col-lg-5">
		<div class="card card-outline-danger text-xs-center">
			<div class="card-header">Delete Component</div>
			<div class="card-block">
				<div class="card-body">
					<blockquote class="card-blockquote">
						<form method="post" accept-charset="UTF-8">
							<input type="hidden" name="id" value="<?= $this->component['id'] ?>">

							<i class="fa fa-trash-o fa-2x"></i>
							<p>Are you sure you want to delete this component?<br />This cannot be undone.</p>

							<a class="btn btn-default" href="/components">Cancel</a>
							<button class="btn btn-primary" type="submit">Confirm Delete</button>

						</form>
					</blockquote>
				</div>
			</div>
		</div>
	</div>
</div>
