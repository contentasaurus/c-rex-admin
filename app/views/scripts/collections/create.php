<ol class="breadcrumb">
  <li><a href="/collections">Collections</a></li>
  <li class="active">Create Collection</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<section class="panel panel-default">
			<header class="panel-heading">
				<h3 class="panel-title">Create Collection</h3>
			</header>
			<form method="POST" action="/collections/create" accept-charset="UTF-8" data-form-ajax="">
				<div class="panel-body">

					<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

					<div class="form-group">
						<input placeholder="Name" class="form-control required" name="collection_name" type="text">
					</div>

				</div>

				<footer class="panel-footer">
					<div class="pull-right">
						<a class="btn btn-default" href="/collections">Cancel</a>
						<button class="btn btn-primary" type="submit">Create</button>
					</div>
				</footer>

			</form>

		</section>
	</div>
</div>
