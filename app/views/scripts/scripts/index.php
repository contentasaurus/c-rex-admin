<?php use puffin\transformer; ?>

<h1>
	<a href="/scripts/upload" class="btn btn-circle btn-add"><span class="material-icons">file_upload</span> Upload Script</a>
	<a href="/scripts/create" class="btn btn-circle btn-add"><span class="material-icons">add_circle</span> Create Script</a>
</h1>

<div class="container-fluid">

	<section class="panel panel-default">
		<header class="panel-heading">
			<h3 class="panel-title"><?= count($this->scripts) ?> Scripts(s)</h3>
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
				<?php foreach( $this->scripts as $script ): ?>
					<tr>
						<td>
							<a href="/scripts/update/<?= $script['id'] ?>" class="btn btn-sm"><span class="material-icons md-18">create</span></a>
							<a href="/scripts/delete/<?= $script['id'] ?>" class="btn btn-sm"><span class="material-icons md-18 danger">cancel</span></a>
						</td>
						<td><?= $script['name'] ?></td>
						<td><?= $script['created_at'] ?></td>
						<td><?= ($script['updated_at'] != '0000-00-00 00:00:00') ? $script['updated_at'] : '--' ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>
</div>
