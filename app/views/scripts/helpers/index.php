<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Helpers', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item pull-xs-left btn btn-link disabled"><?= count($this->helpers) ?> Helper(s)</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/helpers/create"><i class="fa fa-plus"></i> Add Helper</a>
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
				<?php foreach( $this->helpers as $helper ): ?>
					<tr>
						<td>
							<a href="/helpers/update/<?= $helper['id'] ?>" class="btn btn-sm btn-secondary">
								<i class="fa fa-pencil"></i>
							</a>
						</td>
						<td><?= $helper['name'] ?></td>
						<td><?= $helper['description'] ?></td>
						<td><?= $helper['created_at'] ?></td>
						<td><?= ($helper['updated_at'] != '0000-00-00 00:00:00') ? $helper['updated_at'] : '--' ?></td>
						<td>
							<?= $this->partial('delete', [
								'url' => '/helpers/delete/' . $helper['id'],
								'id' => $helper['id'],
							]); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
