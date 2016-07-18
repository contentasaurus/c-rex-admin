<ol class="breadcrumb">
  <li><a href="/articles">Articles</a></li>
  <li class="active">Update Article</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<section id="section_page_content" class="panel panel-primary">
				<header class="panel-heading">
					<h3 class="panel-title">Content</h3>
				</header>
				<div class="panel-body">
					<div>
						<textarea name="article_content" id="article_content"></textarea>
					</div>
				</div>
			</section>

			<section class="panel panel-default">
				<header class="panel-heading">
					<h3 class="panel-title">Details</h3>
				</header>
				<div class="panel-body">
					<div class="form-group">
						<label>Title</label>
						<input placeholder="Name" class="input-lg form-control required" name="title" type="text" value="<?= $this->article['title'] ?>">
					</div>
					<div class="form-group">
						<label>Permalink</label>
						<input placeholder="/my-permalink" class="form-control required" name="permalink" type="text" value="<?= $this->article['permalink'] ?>">
					</div>

					<div class="form-group">
						<label>Type</label>
						<select class="form-control required" name="article_type_id">
							<?php foreach( $this->article_types as $article_type ): ?>
								<option <?php if( $this->article['article_type_id'] == $article_type['id'] ): ?>selected="selected"<?php endif; ?> value="<?= $article_type['id'] ?>"><?= $article_type['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<label>Excerpt</label>
						<textarea class="form-control" name="excerpt"><?= $this->article['excerpt'] ?></textarea>
					</div>

				</div>

			</section>

			<section class="panel panel-default">
				<footer class="panel-footer">
					<button class="btn btn-primary" type="submit">Update</button>
					<a class="btn btn-default" href="/pages">Cancel</a>
				</footer>
			</section>

		</form>
	</div>
</div>

<?php echo $this->partial('articles/medium') ?>
