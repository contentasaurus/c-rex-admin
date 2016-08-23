<?php use puffin\transformer; ?>

<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="/pages">Pages</a></li>
</ol>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item pull-xs-left btn btn-link disabled"><?= count($this->pages) ?> Page(s)</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/pages/create"><i class="fa fa-plus"></i> Add Page</a>
			</li>
		</ul>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="100"><br /></th>
					<th>Name</th>
					<th>Permalink</th>
					<th>Status</th>
					<th>Create Date</th>
					<th>Last Updated</th>
					<th width="50"><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->pages as $page ): ?>
					<tr>
						<td>
							<div class="btn-group" role="group" aria-label="Basic example">
								<a href="/pages/update/<?= $page['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="/pages/copy/<?= $page['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-copy"></i>
								</a>
							</div>
						</td>
						<td><?= $page['page_name'] ?></td>
						<td><?= $page['permalink'] ?></td>
						<td><?= $page['page_status'] ?></td>
						<td><?= $page['created_at'] ?></td>
						<td><?= ($page['updated_at'] != '0000-00-00 00:00:00') ? $page['updated_at'] : '--' ?></td>
						<td>
							<a href="/pages/delete/<?= $page['id'] ?>" class="btn btn-sm btn-danger">
								<i class="fa fa-times"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
