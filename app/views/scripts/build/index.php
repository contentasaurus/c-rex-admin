<?php use puffin\transformer; ?>

<h1><a href="/build/datasource/create/" class="btn btn-circle btn-add"><span class="material-icons">add_circle</span> Add Datasource</a></h1>

<div class="container-fluid">

	<section class="panel panel-default">
		<header class="panel-heading">
			<h3 class="panel-title"><?= count($this->datasources) ?> Datasource(s)</h3>
		</header>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Action</th>
					<th>Name</th>
					<th>DB Name</th>
					<th>DB User</th>
					<th>DB Password</th>
					<th>DB Address</th>
					<th><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->datasources as $datasource ): ?>
					<tr>
						<td width="200">
							<a href="/build/datasource/update/<?= $datasource['id'] ?>" class="btn btn-sm"><span class="material-icons md-18">create</span></a>
							<a href="/build/datasource/delete/<?= $datasource['id'] ?>" class="btn btn-sm"><span class="material-icons md-18 danger">cancel</span></a>
							<a href="/build/datasource/test/<?= $datasource['id'] ?>" class="btn btn-sm"><span class="material-icons md-18">info</span></a>
						</td>
						<td><?= $datasource['name'] ?></td>
						<td><?= $datasource['db_name'] ?></td>
						<td><?= $datasource['db_user'] ?></td>
						<td><?= $datasource['db_password'] ?></td>
						<td><?= $datasource['db_address'] ?></td>
						<td>
							<a href="/build/deploy/<?= $datasource['id'] ?>" class="pull-right btn btn-default btn-sm">Deploy</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>

</div>
