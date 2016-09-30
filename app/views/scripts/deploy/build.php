<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Deploy', 'url' => '/deploy'  ],
	[ 'name'=> 'Build', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item pull-xs-left btn btn-link disabled"><?= count($this->deployments) ?> Deployment(s)</a>
				<button type="button" class="nav-item pull-xs-right btn btn-secondary" data-toggle="popover" data-placement="left" title="Deployment Key" data-html="true" data-content='
					<form class="form-inline" method="post" action="/deploy/build/<?= $this->datasource['id'] ?>">
						<input type="hidden" name="author_user_id" value="<?= $_SESSION['user']['id'] ?>">
						<input type="hidden" name="id" value="<?= $this->datasource['id'] ?>">
						<input type="text" name="key" required class="form-control" value="<?= date('Ymdhis') ?>">
						<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></button>
					</form>
				'>
					<i class="fa fa-plus"></i> Add Deployment
				</button>
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
								<?php if( !$deployment['is_current'] ): ?>
									<button type="button" class="btn btn-warning btn-sm" data-toggle="popover" data-placement="right" data-html="true" data-content='
										<form method="post" action="/deploy/rollback/<?= $deployment['id'] ?>">
											<input type="hidden" name="id" value="<?= $deployment['id'] ?>">
											<input type="hidden" name="datasource_id" value="<?= $datasource['id'] ?>">
											<button type="submit" class="btn btn-warning"><i class="fa fa-history"></i> Confirm Rollback</button>
										</form>
									'>
										<i class="fa fa-history"></i>
									</button>
								<?php else: ?>
									<a class="btn btn-sm btn-info btn-secondary">
										<i class="fa fa-star fa-inverse"></i>
									</a>
								<?php endif; ?>
							</div>
						</td>
						<td><?= $deployment['deployment_key'] ?></td>
						<td><?= $deployment['deployed_by'] ?></td>
						<td><?= $this->datasource['name'] ?></td>
						<td><?= $deployment['created_at'] ?></td>
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
