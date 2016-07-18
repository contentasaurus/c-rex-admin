<?php use puffin\transformer; ?>

<h1><a href="/articles/create" class="btn btn-circle btn-add"><span class="material-icons">add_circle</span> Create Article</a></h1>

<div class="container-fluid">

	<section class="panel panel-default">
		<header class="panel-heading">
			<h3 class="panel-title"><?= count($this->articles) ?> Article(s)</h3>
		</header>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Action</th>
					<th>Title</th>
					<th>Excerpt</th>
					<th>Type</th>
					<th>Permalink</th>
					<th>Create Date</th>
					<th>Last Updated</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->articles as $article ): ?>
					<tr>
						<td>
							<a href="/pages/update/<?= $article['id'] ?>" class="btn btn-sm"><span class="material-icons md-18">create</span></a>
							<a href="/pages/delete/<?= $article['id'] ?>" class="btn btn-sm"><span class="material-icons md-18 danger">cancel</span></a>
						</td>
						<td><?= $article['title'] ?></td>
						<td><?= $article['excerpt'] ?></td>
						<td><?= $article['article_type_id'] ?></td>
						<td><?= $article['permalink'] ?></td>
						<td><?= $article['created_at'] ?></td>
						<td><?= ($article['updated_at'] != '0000-00-00 00:00:00') ? $article['updated_at'] : '--' ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>
</div>
