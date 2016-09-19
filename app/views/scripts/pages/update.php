<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Pages', 'url' => '/pages' ],
	[ 'name'=> 'Update Page', 'active' => 'true' ],
]]); ?>

<div class="card">
	<div class="card-header">
		<?= $this->partial('tabs', [ 'classes' => 'card-header-tabs pull-xs-left', 'tabs' => [
			[ 'name'=> 'Contents', 'active' => 'active', 'url' => "/pages/update/{$this->page['id']}" ],
			[ 'name'=> 'Data', 'url' => "/pages/update/{$this->page['id']}/data" ],
		]]); ?>
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="id" type="hidden" value="<?= $this->page['id'] ?>">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label>Permalink</label>
				<input placeholder="/my-permalink" class="form-control required" name="permalink" type="text" value="<?= $this->page['permalink'] ?>">
			</div>

			<div class="form-group">
				<label>Name</label>
				<input placeholder="Name" class="form-control required" name="page_name" type="text" value="<?= $this->page['name'] ?>">
			</div>

			<button type="submit" class="btn btn-primary">Save</button>
			<a class="btn btn-secondary" href="/pages">Cancel</a>
		</form>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item pull-xs-left btn btn-link disabled">Contents</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/pages/update/<?= $this->page['id'] ?>/version-create/"><i class="fa fa-plus"></i> Add Version</a>
			</li>
		</ul>
	</div>
	<?php if( !empty($this->page_versions) ): ?>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th width="110"><br /></th>
					<th width="110">Split %</th>
					<th width="200">Updated</th>
					<th>Updated By</th>
					<th>Comments</th>
					<th width="120"><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->page_versions as $version ): ?>
					<tr>
						<td>
							<div class="btn-group" role="group">
								<a href="/pages/update/<?= $this->page['id'] ?>/version-update/<?= $version['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="/pages/update/<?= $this->page['id'] ?>/version-copy/<?= $version['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-copy"></i>
								</a>
							</div>
						</td>
						<td>
							<?php if( $version['is_publishable'] ): ?>
								<input type="number" name="version[<?= $version['id'] ?>][split]" class="form-control" value="<?= $version['percentage'] ?>"  />
							<?php endif; ?>
						</td>
						<td><?php if($version['updated_at'] == '0000-00-00 00:00:00'){ echo $version['created_at']; } else { echo $version['updated_at']; } ?></td>
						<td><?= $version['author_first_name'] ?> <?= $version['author_last_name'] ?></td>
						<td><?= $version['comments'] ?></td>
						<td>
							<form class="form-inline" method="post" action="/pages/update/<?= $this->page['id'] ?>/version-delete/<?= $version['id'] ?>">
								<?php if( $version['is_publishable'] ): ?>
									<a href="/pages/update/<?= $this->page['id'] ?>/version-publish/<?= $version['id'] ?>/state/0" class="btn btn-sm btn-success">On</a>
								<?php else: ?>
									<a href="/pages/update/<?= $this->page['id'] ?>/version-publish/<?= $version['id'] ?>/state/1" class="btn btn-sm btn-secondary">Off</a>
								<?php endif; ?>
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
	<?php else: ?>
		<div class="card-block">
			<div class="card-block">
				<blockquote class="card-blockquote">
					This page has no versions.
				</blockquote>
			</div>
		</div>
	<?php endif; ?>
</div>
