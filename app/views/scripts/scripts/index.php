<?php use puffin\transformer; ?>

<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="/scripts">Scripts</a></li>
</ol>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item pull-xs-left btn btn-link disabled"><?= count($this->scripts) ?> Scripts(s)</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/scripts/create">
					<i class="fa fa-plus"></i> Add Script
				</a>
			</li>
		</ul>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="50"><br /></th>
					<th>Name</th>
					<th>Create Date</th>
					<th>Last Updated</th>
					<th width="50"><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->scripts as $script ): ?>
					<tr>
						<td>
							<a href="/scripts/update/<?= $script['id'] ?>" class="btn btn-sm btn-secondary">
								<i class="fa fa-pencil"></i>
							</a>
						</td>
						<td><?= $script['name'] ?></td>
						<td><?= $script['created_at'] ?></td>
						<td><?= ($script['updated_at'] != '0000-00-00 00:00:00') ? $script['updated_at'] : '--' ?></td>
						<td>
							<a href="/scripts/delete/<?= $script['id'] ?>" class="btn btn-sm btn-danger">
								<i class="fa fa-times"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
