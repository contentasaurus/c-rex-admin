<?php use puffin\transformer; ?>

<h1><a href="/data/create" class="btn btn-circle btn-add"><span class="material-icons">add_circle</span> Create Data</a></h1>

<div class="container-fluid">

	<section class="panel panel-default">
		<header class="panel-heading">
			<h3 class="panel-title"><?= count($this->data) ?> Data</h3>
		</header>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Action</th>
					<th>Name</th>
					<th>Create Date</th>
					<th>Last Updated</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->data as $data ): ?>
					<tr>
						<td>
							<a href="/data/update/<?= $data['id'] ?>" class="btn btn-sm"><span class="material-icons md-18">create</span></a>
							<a href="/data/delete/<?= $data['id'] ?>" class="btn btn-sm"><span class="material-icons md-18 danger">cancel</span></a>
						</td>
						<td><?= $data['name'] ?></td>
						<td><?= $data['created_at'] ?></td>
						<td><?= ($data['updated_at'] != '0000-00-00 00:00:00') ? $data['updated_at'] : '--' ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>
</div>
