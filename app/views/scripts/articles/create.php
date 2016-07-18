<ol class="breadcrumb">
  <li><a href="/articles">Articles</a></li>
  <li class="active">Create Articles</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<section class="panel panel-default">
			<header class="panel-heading">
				<h3 class="panel-title">Create Article</h3>
			</header>
			<form method="POST" accept-charset="UTF-8" data-form-ajax="">
				<div class="panel-body">

					<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

					<div class="form-group">
						<label>Title</label>
						<input placeholder="Name" class="form-control required" name="title" type="text">
					</div>

					<div class="form-group">
						<label>Permalink</label>
						<input placeholder="/my-permalink" class="form-control required" name="permalink" type="text">
					</div>

					<div class="form-group">
						<label>Type</label>
						<select class="form-control required" name="article_type_id">
							<?php foreach( $this->article_types as $article_type ): ?>
								<option value="<?= $article_type['id'] ?>"><?= $article_type['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>

				</div>

				<footer class="panel-footer">
					<button class="btn btn-primary" type="submit">Next</button>
					<a class="btn btn-default" href="/articles">Cancel</a>
				</footer>

			</form>

		</section>
	</div>
</div>
