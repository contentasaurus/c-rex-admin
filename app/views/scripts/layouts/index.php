<?php use puffin\transformer; ?>

<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="/layouts">Layouts</a></li>
</ol>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item pull-xs-left btn btn-link disabled"><?= count($this->layouts) ?> Layout(s)</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/layouts/create"><i class="fa fa-plus"></i> Add Layout</a>
			</li>
		</ul>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="100"><br /></th>
					<th>Name</th>
					<th>Description</th>
					<th>Create Date</th>
					<th>Last Updated</th>
					<th width="50"><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->layouts as $block ): ?>
					<tr>
						<td>
							<div class="btn-group" role="group" aria-label="Basic example">
								<a href="/layouts/update/<?= $block['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="/layouts/copy/<?= $block['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-copy"></i>
								</a>
							</div>
						</td>
						<td><?= $block['name'] ?></td>
						<td><?= $block['description'] ?></td>
						<td><?= $block['created_at'] ?></td>
						<td><?= ($block['updated_at'] != '0000-00-00 00:00:00') ? $block['updated_at'] : '--' ?></td>
						<td>
							<a href="/layouts/delete/<?= $block['id'] ?>" class="btn btn-sm btn-danger">
								<i class="fa fa-times"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
