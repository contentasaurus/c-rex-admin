<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Deploy', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item pull-xs-left btn btn-link disabled"><?= count($this->datasources) ?> Datasource(s)</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/deploy/datasource/create/"><i class="fa fa-plus"></i> Add Datasource</a>
			</li>
		</ul>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="100"><br></th>
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
								<a href="/deploy/datasource/update/<?= $datasource['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="/deploy/datasource/test/<?= $datasource['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-plug"></i>
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
							<form method="post" action="/deploy/delete/<?= $datasource['id'] ?>">
								<input type="hidden" name="id" value="<?= $datasource['id'] ?>">
								<div class="btn-group" role="group">
									<button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-times"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<button type="submit" class="dropdown-item" href="#"><i class="fa fa-times"></i> Confirm Delete</button>
									</div>
								</div>
							</form>
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
				<a class="nav-item pull-xs-left btn btn-link disabled"><?= count($this->deployments) ?> Deployment(s)</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/deploy/deployment/create/"><i class="fa fa-plus"></i> Add Deployment</a>
			</li>
		</ul>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="50"><br></th>
					<th>Key</th>
					<th>Deployed By</th>
					<th>Deployed To</th>
					<th>Deployed At</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->deployments as $deployment ): ?>
					<tr>
						<td>
							<div class="btn-group">
								<a href="/deploy/datasource/update/<?= $deployment['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-pencil"></i>
								</a>
							</div>
						</td>
						<td><?= $deployment['key'] ?></td>
						<td><?= $deployment['first_name'] ?> <?= $deployment['last_name'] ?></td>
						<td><?= $deployment['name'] ?></td>
						<td><?= $deployment['deployed_at'] ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
