<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Pages', 'url' => '/pages' ],
	[ 'name'=> 'Update Page', 'active' => 'true' ],
]]); ?>

<div class="card">
	<div class="card-header">
		<?= $this->partial('tabs', [ 'classes' => 'card-header-tabs pull-xs-left', 'tabs' => [
			[ 'name'=> 'Contents', 'url' => "/pages/update/{$this->page['id']}" ],
			[ 'name'=> 'Versions', 'active' => 'active', 'url' => "/pages/update/{$this->page['id']}/versions" ],
			[ 'name'=> 'Data', 'url' => "/pages/update/{$this->page['id']}/data" ],
			[ 'name'=> 'Status', 'url' => "/pages/update/{$this->page['id']}/status" ],
			[ 'name'=> 'History', 'url' => "/pages/update/{$this->page['id']}/history" ]
		]]); ?>
	</div>
	<?php if( !empty($this->page_versions) ): ?>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th width="110"><br /></th>
					<th width="200">Updated</th>
					<th>Updated By</th>
					<th width="50"><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->page_versions as $version ): ?>
					<tr>
						<td>
							<div class="btn-group" role="group">
								<a href="/pages/update/<?= $this->page['id'] ?>/versions/update/<?= $version['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-pencil"></i>
								</a>
								<div class="btn-group" role="group">
									<button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fa fa-arrow-circle-up"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
										<a class="dropdown-item" href="/pages/update/<?= $this->page['id'] ?>/versions/promote/<?= $version['id'] ?>">
											<i class="fa fa-check-circle"></i> Promote
										</a>
										<a class="dropdown-item" href="#">
											<i class="fa fa-info-circle"></i> What's this?
										</a>
									</div>
								</div>
							</div>
						</td>
						<td><?php if($version['updated_at'] == '0000-00-00 00:00:00'){ echo $version['created_at']; } else { echo $version['updated_at']; } ?></td>
						<td><?= $version['author_first_name'] ?> <?= $version['author_last_name'] ?></td>
						<td>
							<a href="/pages/update/<?= $this->page['id'] ?>/version/delete/<?= $version['id'] ?>" class="btn btn-sm btn-danger">
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
					This page has no versions.

					<form method="post">
						<input type="hidden" name="page_id" value="<?= $this->page['id'] ?>">
						<button class="btn btn-primary">
							Create One
						</button>
					</form>
				</blockquote>
			</div>
		</div>
	<?php endif; ?>
</div>
