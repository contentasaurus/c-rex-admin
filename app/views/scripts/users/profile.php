<?php use \puffin\transformer; ?>

<div class="card">
	<div class="card-header">
		My Profile
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<?php unset($this->user['password']) ?>
			<?php $this->user['role'] = transformer::role2str($this->user['role_id']) ?>
			<?php unset($this->user['role_id']) ?>
			<?php foreach( $this->user as $k => $v ): ?>
				<tr align="left">
					<th><?= $k ?></th>
					<td><?= $v ?></td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>
