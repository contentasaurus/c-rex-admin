<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Datatypes', 'url' => '/datatypes'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item pull-xs-left btn btn-link disabled"><?= count($this->datatypes) ?> Datatypes</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/datatypes/create"><i class="fa fa-plus"></i> Add</a>
			</li>
		</ul>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="50"><br /></th>
					<th>Name</th>
					<th>Create Date</th>
					<th>Last Updated</th>
					<th width="50"><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->datatypes as $datatypes ): ?>
					<tr>
						<td>
							<a href="/datatypes/update/<?= $datatypes['id'] ?>" class="btn btn-sm btn-secondary">
								<i class="fa fa-pencil"></i>
							</a>
						</td>
						<td><?= $datatypes['name'] ?></td>
						<td><?= $datatypes['created_at'] ?></td>
						<td><?= ($datatypes['updated_at'] != '0000-00-00 00:00:00') ? $datatypes['updated_at'] : '--' ?></td>
						<td>
							<?= $this->partial('delete', [
								'url' => '/datatypes/delete/' . $datatypes['id'],
								'id' => $datatypes['id'],
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
				<a class="nav-item pull-xs-left btn btn-link disabled"><?= count($this->site_data) ?> Site Data</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/datatypes/site-data/create"><i class="fa fa-plus"></i> Add</a>
			</li>
		</ul>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="50"><br /></th>
					<th>Reference Name</th>
					<th>Create Date</th>
					<th>Last Updated</th>
					<th width="50"><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->site_data as $site_data ): ?>
					<tr>
						<td>
							<a href="/datatypes/site-data/update/<?= $site_data['id'] ?>" class="btn btn-sm btn-secondary">
								<i class="fa fa-pencil"></i>
							</a>
						</td>
						<td>Site.<?= $site_data['reference_name'] ?></td>
						<td><?= $site_data['created_at'] ?></td>
						<td><?= ($site_data['updated_at'] != '0000-00-00 00:00:00') ? $site_data['updated_at'] : '--' ?></td>
						<td>
							<?= $this->partial('delete', [
								'url' => '/datatypes/site-data/delete/' . $site_data['id'],
								'id' => $site_data['id'],
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
