<h1><span class="icon-people"></span> Users <a href="/users/create" class="btn btn-circle btn-add"><span class="icon-add"></span></a></h1>

<div class="container-fluid">

	<section class="panel panel-default">
		<header class="panel-heading">
			<!-- <div class="col-md-4 pull-right"><input type="search" class="form-control" name="search" placeholder="Search"></div> -->
		</header>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Action</th>
					<th>Name</th>
					<th>Role</th>
					<th>Email</th>
					<th>Create Date</th>
					<th><span class="pull-right"><span class="total-count"><?= count($this->users) ?></span> Users</span></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->users as $user ): ?>
					<tr>
						<td>
							<a href="/users/edit/<?= $user['id'] ?>" class="btn btn-default btn-action icon-edit"><span class="tool-tip">Edit</span></a>
							<button data-url="/users/delete/<?= $user['id'] ?>" class="btn btn-danger btn-action icon-clear" data-remove><span class="tool-tip">Remove</span></button>
						</td>
						<td><?= $user['first_name'] ?> <?= $user['last_name'] ?></td>
						<td><?= \puffin\transformer::role2str($user['role_id']) ?></td>
						<td><?= $user['email'] ?></td>
						<td colspan="2"><?= $user['created_at'] ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>
</div>
