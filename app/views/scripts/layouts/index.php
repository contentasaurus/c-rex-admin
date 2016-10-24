<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Layouts', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item float-xs-left btn btn-link disabled"><?= count($this->layouts) ?> Layout(s)</a>
				<a class="nav-item float-xs-right btn btn-secondary" href="/layouts/create"><i class="fa fa-plus"></i> Add</a>
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
							<?= $this->partial('delete', [
								'url' => '/layouts/delete/' . $block['id'],
								'id' => $block['id'],
							]); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item float-xs-left btn btn-link disabled"><?= count($this->scripts) ?> Scripts(s)</a>
				<a class="nav-item float-xs-right btn btn-secondary" href="/scripts/create"><i class="fa fa-plus"></i> Add</a>
			</li>
		</ul>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="50"><br /></th>
					<th>Name</th>
					<th>Type</th>
					<th>Create Date</th>
					<th>Last Updated</th>
					<th>Priority</th>
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
						<td><?= $script['type'] ?></td>
						<td><?= $script['created_at'] ?></td>
						<td><?= ($script['updated_at'] != '0000-00-00 00:00:00') ? $script['updated_at'] : '--' ?></td>
						<td><?= $script['priority'] ?></td>
						<td>
							<?= $this->partial('delete', [
								'url' => '/scripts/delete/' . $script['id'],
								'id' => $script['id'],
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
		$('[data-toggle="popover"]').popover({
		});
	});
</script>
