<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Pages', 'url' => '/pages' ],
	[ 'name'=> 'Update Page', 'active' => 'true' ],
]]); ?>

<div class="card">
	<div class="card-header">
		Page information
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="id" type="hidden" value="<?= $this->page['id'] ?>">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label>Page Name</label>
				<input placeholder="Name" class="form-control required" name="page_name" type="text" value="<?= $this->page['name'] ?>">
			</div>

			<div class="form-group">
				<label>Permalink</label>
				<input placeholder="/my-permalink" class="form-control required" name="permalink" type="text" value="<?= $this->page['permalink'] ?>">
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
				<a class="nav-item float-xs-left btn btn-link disabled" style="color:black">Page Data</a>
				<a class="nav-item float-xs-right btn btn-secondary" href="/pages/update/<?= $this->page['id'] ?>/data-create/"><i class="fa fa-plus"></i> Add</a>
			</li>
		</ul>
	</div>
	<?php if( !empty($this->page_data) ): ?>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th width="50"><br /></th>
					<th>Key</th>
					<th>Type</th>
					<th>By</th>
					<th>Last Updated</th>
					<th width="50"><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->page_data as $data ): ?>
					<tr>
						<td>
							<a href="/pages/update/<?= $this->page['id'] ?>/data-update/<?= $data['id'] ?>" class="btn btn-secondary btn-sm">
								<i class="fa fa-pencil"></i>
							</a>
						</td>
						<td>Page.<?= $data['reference_name'] ?></td>
						<td><?= $data['datatype_name'] ?></td>
						<td><?= $data['first_name'] ?> <?= $data['last_name'] ?></td>
						<td><?= $data['updated_at'] ?></td>
						<td>
							<?= $this->partial('delete', [
								'url' => "/pages/update/{$this->page['id']}/data-delete/{$data['id']}",
								'id' => $data['id'],
							]); ?>
						</td>

					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="card-block">
			<div class="card-block">
				<blockquote class="card-blockquote">
					This page has no data objects associated with it.
				</blockquote>
			</div>
		</div>
	<?php endif; ?>
</div>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item float-xs-left btn btn-link disabled" style="color:black">Versions</a>
				<a class="nav-item float-xs-right btn btn-secondary" href="/pages/update/<?= $this->page['id'] ?>/version-create/"><i class="fa fa-plus"></i> Add</a>
			</li>
		</ul>
	</div>
	<?php if( !empty($this->page_versions) ): ?>
		<form id="version-split-form" method="post" action="/pages/update/<?= $this->page['id'] ?>/version-split-update">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th width="150"><br /></th>
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
									<a target="_blank" href="/preview/<?= $version['id'] ?>" class="btn btn-sm btn-secondary">
										<i class="fa fa-eye"></i>
									</a>
								</div>
							</td>
							<td>
								<?php if( $version['is_publishable'] ): ?>
									<input type="number" name="version[<?= $version['id'] ?>][percentage]" class="form-control version-split-percentage" min="0" max="100" value="<?= $version['percentage'] ?>"  />
								<?php endif; ?>
							</td>
							<td><?php if($version['updated_at'] == '0000-00-00 00:00:00'){ echo $version['created_at']; } else { echo $version['updated_at']; } ?></td>
							<td><?= $version['author_first_name'] ?> <?= $version['author_last_name'] ?></td>
							<td><?= $version['comments'] ?></td>
							<td>
								<?php if( $version['is_publishable'] ): ?>
									<a href="/pages/update/<?= $this->page['id'] ?>/version-publish/<?= $version['id'] ?>/state/0" class="btn btn-sm btn-success">On</a>
								<?php else: ?>
									<a href="/pages/update/<?= $this->page['id'] ?>/version-publish/<?= $version['id'] ?>/state/1" class="btn btn-sm btn-secondary">Off</a>
								<?php endif; ?>
								<?= $this->partial('delete', [
									'url' => "/pages/update/{$this->page['id']}/version-delete/{$version['id']}",
									'id' => $version['id'],
								]); ?>
							</td>
						</tr>
					<?php endforeach; ?>
					<tr>
						<td></td>
						<td>
							<button type="submit" class="btn btn-primary btn-block">Save</button>
						</td>
						<td colspan="4">
							<small id="split-help" class="form-text text-muted">Percentages must add up to 100. Not more or less.</small>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
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

<script>
	$(function(){
		$('#split-help').hide();

		$('[data-toggle="popover"]').popover();

		$('#version-split-form').on('submit', function(event){
			var $percentage = 0;

			$('.version-split-percentage').each(function(i){
				$percentage += parseInt($(this).val());
			});

			if( $percentage != 100 )
			{
				$('#split-help').show();
				event.preventDefault();
				return false;
			}

		});
	});
</script>
