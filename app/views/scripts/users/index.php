<?php use puffin\transformer; ?>

<h1><a href="/users/create" class="btn btn-circle btn-add"><span class="material-icons">add_circle</span> Create User</a></h1>

<div class="container-fluid">

	<section class="panel panel-default">
		<header class="panel-heading">
			<h3 class="panel-title"><?= count($this->users) ?> User(s)</h3>
		</header>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Action</th>
					<th>Name</th>
					<th>Role</th>
					<th>Email</th>
					<th>Create Date</th>
					<th>Last Updated</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->users as $user ): ?>
					<tr <?php if( !$user['is_active'] ): ?> class="text-muted" <?php endif; ?>>
						<td>
							<a href="/users/update/<?= $user['id'] ?>" class="btn btn-sm"><span class="material-icons md-18">create</span></a>
							<?php if( $user['id'] != $_SESSION['user']['id'] ): ?>
								<?php if( $user['is_active'] ): ?>
									<a href="/users/disable/<?= $user['id'] ?>" class="btn btn-sm"><span class="material-icons md-18 danger">cancel</span></a>
								<?php else: ?>
									<a href="/users/enable/<?= $user['id'] ?>" class="btn btn-sm"><span class="material-icons md-18 success">highlight_off</span></a>
								<?php endif; ?>
							<?php endif; ?>
						</td>
						<td><?= $user['first_name'] ?> <?= $user['last_name'] ?></td>
						<td><?= transformer::role2str($user['role_id']) ?></td>
						<td><?= $user['email'] ?></td>
						<td><?= $user['created_at'] ?></td>
						<td><?= ($user['updated_at'] != '0000-00-00 00:00:00') ? $user['updated_at'] : '--' ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>
</div>
