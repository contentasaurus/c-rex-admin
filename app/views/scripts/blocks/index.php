<?php use puffin\transformer; ?>

<h1><a href="/blocks/create" class="btn btn-circle btn-add"><span class="material-icons">add_circle</span> Create Block</a></h1>

<div class="container-fluid">

	<section class="panel panel-default">
		<header class="panel-heading">
			<h3 class="panel-title"><?= count($this->blocks) ?> Block(s)</h3>
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
				<?php foreach( $this->blocks as $block ): ?>
					<tr>
						<td>
							<a href="/blocks/update/<?= $block['id'] ?>" class="btn btn-sm"><span class="material-icons md-18">create</span></a>
							<a href="/blocks/delete/<?= $block['id'] ?>" class="btn btn-sm"><span class="material-icons md-18 danger">cancel</span></a>
						</td>
						<td><?= $block['name'] ?></td>
						<td><?= $block['description'] ?></td>
						<td><?= $block['created_at'] ?></td>
						<td><?= ($block['updated_at'] != '0000-00-00 00:00:00') ? $block['updated_at'] : '--' ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>
</div>
