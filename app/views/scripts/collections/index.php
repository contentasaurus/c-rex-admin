<?php use puffin\transformer; ?>

<h1><a href="/collections/create" class="btn btn-circle btn-add"><span class="material-icons">add_circle</span> Create Collection</a></h1>

<div class="container-fluid">

	<section class="panel panel-default">
		<header class="panel-heading">
			<h3 class="panel-title"><?= count($this->collections) ?> Collection(s)</h3>
		</header>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Action</th>
					<th>Name</th>
					<th>Index</th>
					<th>Data</th>
					<th>Create Date</th>
					<th>Last Updated</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->collections as $collection ): ?>
					<tr>
						<td>
							<a href="/collections/update/<?= $collection['id'] ?>" class="btn btn-sm"><span class="material-icons md-18">create</span></a>
							<a href="/collections/delete/<?= $collection['id'] ?>" class="btn btn-sm"><span class="material-icons md-18 danger">cancel</span></a>
						</td>
						<td><?= $collection['collection_name'] ?></td>
						<td><?= $collection['collection_index'] ?></td>
						<td><?= $collection['collection_data'] ?></td>
						<td><?= $collection['created_at'] ?></td>
						<td><?= ($collection['updated_at'] != '0000-00-00 00:00:00') ? $collection['updated_at'] : '--' ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>
</div>
