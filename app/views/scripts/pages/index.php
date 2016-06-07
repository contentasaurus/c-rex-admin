<?php use puffin\transformer; ?>

<h1><a href="/pages/create" class="btn btn-circle btn-add"><span class="material-icons">add_circle</span> Create Page</a></h1>

<div class="container-fluid">

	<section class="panel panel-default">
		<header class="panel-heading">
			<h3 class="panel-title"><?= count($this->pages) ?> Page(s)</h3>
		</header>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Action</th>
					<th>Name</th>
					<th>Type</th>
					<th>Status</th>
					<th>Permalink</th>
					<th>Create Date</th>
					<th>Last Updated</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->pages as $page ): ?>
					<tr>
						<td>
							<a href="/pages/update/<?= $page['id'] ?>" class="btn btn-sm"><span class="material-icons md-18">create</span></a>
							<a href="/pages/delete/<?= $page['id'] ?>" class="btn btn-sm"><span class="material-icons md-18 danger">cancel</span></a>
						</td>
						<td><?= $page['page_name'] ?></td>
						<td><?= $page['page_type_id'] ?></td>
						<td><?= $page['page_status_id'] ?></td>
						<td><?= $page['permalink'] ?></td>
						<td><?= $page['created_at'] ?></td>
						<td><?= ($page['updated_at'] != '0000-00-00 00:00:00') ? $page['updated_at'] : '--' ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>
</div>
