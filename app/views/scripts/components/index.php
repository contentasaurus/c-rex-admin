<?php use puffin\transformer; ?>

<h1><a href="/components/create" class="btn btn-circle btn-add"><span class="material-icons">add_circle</span> Create Component</a></h1>

<div class="container-fluid">

	<section class="panel panel-default">
		<header class="panel-heading">
			<h3 class="panel-title"><?= count($this->components) ?> Component(s)</h3>
		</header>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Action</th>
					<th>Name</th>
					<th>Description</th>
					<th>Create Date</th>
					<th>Last Updated</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->components as $component ): ?>
					<tr>
						<td>
							<a href="/components/update/<?= $component['id'] ?>" class="btn btn-sm"><span class="material-icons md-18">create</span></a>
							<a href="/components/delete/<?= $component['id'] ?>" class="btn btn-sm"><span class="material-icons md-18 danger">cancel</span></a>
						</td>
						<td><?= $component['name'] ?></td>
						<td><?= $component['description'] ?></td>
						<td><?= $component['created_at'] ?></td>
						<td><?= ($component['updated_at'] != '0000-00-00 00:00:00') ? $component['updated_at'] : '--' ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>
</div>
