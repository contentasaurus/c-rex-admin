<?php use puffin\transformer; ?>

<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="/datatypes">Datatypes</a></li>
</ol>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item pull-xs-left btn btn-link disabled"><?= count($this->datatypes) ?> Datatypes</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/datatypes/create"><i class="fa fa-plus"></i> Add Datatypes</a>
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
				<?php foreach( $this->datatypes as $datatypes ): ?>
					<tr>
						<td>
							<a href="/datatypes/update/<?= $datatypes['id'] ?>" class="btn btn-sm btn-secondary">
								<i class="fa fa-pencil"></i>
							</a>
						</td>
						<td><?= $datatypes['name'] ?></td>
						<td><?= $datatypes['created_at'] ?></td>
						<td><?= ($datatypes['updated_at'] != '0000-00-00 00:00:00') ? $datatypes['updated_at'] : '--' ?></td>
						<td>
							<a href="/datatypes/delete/<?= $datatypes['id'] ?>" class="btn btn-sm btn-danger">
								<i class="fa fa-times"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
