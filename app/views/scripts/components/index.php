<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Components', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item float-xs-left btn btn-link disabled" style="color:black"><?= count($this->components) ?> Component(s)</a>
				<a class="nav-item float-xs-right btn btn-secondary" href="/components/create"><i class="fa fa-plus"></i> Add</a>
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
					<th>Priority</th>
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
						<td><?= $component['priority'] ?></td>
						<td><?= ($component['updated_at'] != '0000-00-00 00:00:00') ? $component['updated_at'] : '--' ?></td>
						<td>
							<?= $this->partial('delete', [
								'url' => '/components/delete/' . $component['id'],
								'id' => $component['id'],
							]); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(function(){
		$('[data-toggle="popover"]').popover();
	});
</script>
