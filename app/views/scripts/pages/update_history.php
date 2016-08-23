<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/pages">Pages</a></li>
	<li class="breadcrumb-item active">Update Page</li>
</ol>

<div class="card">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs pull-xs-left">
			<li class="nav-item">
				<a class="nav-link" href="/pages/update/<?= $this->page['id'] ?>">Contents</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/pages/update/<?= $this->page['id'] ?>/data">Data</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/pages/update/<?= $this->page['id'] ?>/status">Status</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="/pages/update/<?= $this->page['id'] ?>/history">History</a>
			</li>
		</ul>
	</div>
	<?php if( !empty($this->page_history) ): ?>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th width="100"><br /></th>
					<th width="200">Date</th>
					<th>Changed By</th>
					<th>Title</th>
					<th>Permalink</th>
					<th>Layout</th>
					<th>Status</th>
					<th width="50"><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->page_history as $version ): ?>
					<tr>
						<td>
							<div class="btn-group" role="group">
								<a href="#" class="btn btn-sm btn-secondary">
									<i class="fa fa-eye"></i>
								</a>
								<a href="#" class="btn btn-sm btn-secondary">
									<i class="fa fa-history"></i>
								</a>
							</div>
						</td>
						<td><?= $version['created_at'] ?></td>
						<td><?= $version['author_first_name'] ?> <?= $version['author_last_name'] ?></td>
						<td><?= $version['page_name'] ?></td>
						<td><?= $version['permalink'] ?></td>
						<td><?= $version['page_layout_name'] ?></td>
						<td><?= $version['page_status_name'] ?></td>
						<td>
							<a href="/pages/version/delete/<?= $version['id'] ?>" class="btn btn-sm btn-danger">
								<i class="fa fa-times"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="card-block">
			<div class="card-block">
				<blockquote class="card-blockquote">
					This page has never been changed.
				</blockquote>
			</div>
		</div>
	<?php endif; ?>
</div>
