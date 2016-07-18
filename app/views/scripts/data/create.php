<ol class="breadcrumb">
  <li><a href="/data">Data</a></li>
  <li class="active">Create Data</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<section class="panel panel-default">
			<header class="panel-heading">
				<h3 class="panel-title">Create Data</h3>
			</header>
			<form method="POST" action="/data/create" accept-charset="UTF-8" data-form-ajax="">
				<div class="panel-body">

					<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

					<div class="form-group">
						<input placeholder="Name" class="form-control required" name="name" type="text">
					</div>

				</div>

				<footer class="panel-footer">
					<button class="btn btn-primary" type="submit">Next</button>
					<a class="btn btn-default" href="/data">Cancel</a>
				</footer>

			</form>

		</section>
	</div>
</div>
