<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Users', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item pull-xs-left btn btn-link disabled"><?= count($this->users) ?> users(s)</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/users/create"><i class="fa fa-plus"></i> Add User</a>
			</li>
		</ul>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="100"><br /></th>
					<th>Name</th>
					<th>Role</th>
					<th>Email</th>
					<th>Create Date</th>
					<th width="50"><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->users as $user ): ?>
					<tr <?php if( !$user['is_active'] ): ?> class="text-muted" <?php endif; ?>>
						<td>
							<div class="btn-group">
								<a href="/users/update/<?= $user['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="/users/reset/<?= $user['id'] ?>" class="btn btn-sm btn-secondary">
									<i class="fa fa-key"></i>
								</a>
							</div>
						</td>
						<td><?= $user['first_name'] ?> <?= $user['last_name'] ?></td>
						<td>
							<?php if( !$user['is_active'] ): ?>
								Disabled
							<?php else: ?>
								<?php if( $user['is_admin'] == 2 ): ?>
									Site Owner
								<?php elseif( $user['is_admin'] == 1 ): ?>
									Administrator
								<?php else: ?>
									Standard
								<?php endif; ?>
							<?php endif; ?>
						</td>
						<td><?= $user['email'] ?></td>
						<td><?= $user['created_at'] ?></td>
						<td>
							<?php if( $user['id'] != $_SESSION['user']['id'] ): ?>
								<?php if( $user['is_active'] ): ?>
									<a href="/users/disable/<?= $user['id'] ?>" class="btn btn-sm btn-success">
										On
									</a>
								<?php else: ?>
									<a href="/users/enable/<?= $user['id'] ?>" class="btn btn-sm btn-danger">
										Off
									</a>
								<?php endif; ?>
							<?php else: ?>
								<a class="btn btn-sm btn-info disable">
									You
								</a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
