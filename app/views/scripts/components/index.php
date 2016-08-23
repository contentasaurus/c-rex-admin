<?php use puffin\transformer; ?>

<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="/components">Components</a></li>
</ol>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item pull-xs-left btn btn-link disabled"><?= count($this->components) ?> Component(s)</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/components/create"><i class="fa fa-plus"></i> Add Component</a>
			</li>
		</ul>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="50"><br /></th>
					<th>Name</th>
					<th>Description</th>
					<th>Create Date</th>
					<th>Last Updated</th>
					<th width="50"><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->components as $component ): ?>
					<tr>
						<td>
							<a href="/components/update/<?= $component['id'] ?>" class="btn btn-sm btn-secondary">
								<i class="fa fa-pencil"></i>
							</a>
						</td>
						<td><?= $component['name'] ?></td>
						<td><?= $component['description'] ?></td>
						<td><?= $component['created_at'] ?></td>
						<td><?= ($component['updated_at'] != '0000-00-00 00:00:00') ? $component['updated_at'] : '--' ?></td>
						<td>
							<a href="/components/delete/<?= $component['id'] ?>" class="btn btn-sm btn-danger">
								<i class="fa fa-times"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
