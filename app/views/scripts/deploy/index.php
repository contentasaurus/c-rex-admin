<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Deploy', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item float-xs-left btn btn-link disabled"><?= count($this->datasources) ?> Datasource(s)</a>
				<a class="nav-item float-xs-right btn btn-secondary" href="/deploy/create/"><i class="fa fa-plus"></i> Add</a>
			</li>
		</ul>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="150"><br></th>
					<th>Name</th>
					<th>DB Name</th>
					<th>Username</th>
					<th>Host</th>
					<th>Port</th>
					<th>Description</th>
					<th width="50"><br></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->datasources as $datasource ): ?>
					<tr>
						<td>
							<div class="btn-group">
								<a href="/deploy/update/<?= $datasource['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="/deploy/test/<?= $datasource['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-question-circle"></i>
								</a>
								<a href="/deploy/build/<?= $datasource['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-cloud-upload"></i>
								</a>
							</div>
						</td>
						<td><?= $datasource['name'] ?></td>
						<td><?= $datasource['dbname'] ?></td>
						<td><?= $datasource['username'] ?></td>
						<td><?= $datasource['host'] ?></td>
						<td><?= $datasource['port'] ?></td>
						<td><?= $datasource['description'] ?></td>
						<td>
							<?= $this->partial('delete', [
								'url' => '/deploy/delete/' . $datasource['id'],
								'id' => $datasource['id'],
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
