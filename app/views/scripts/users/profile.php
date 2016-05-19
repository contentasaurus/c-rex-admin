<?php use \puffin\transformer; ?>
<h1><span class="material-icons md-48">face</span> Profile</h1>

<table class="table table-striped table-bordered">
	<?php unset($this->user['password']) ?>
	<?php $this->user['role'] = transformer::role2str($this->user['role_id']) ?>
	<?php unset($this->user['role_id']) ?>
	<?php foreach( $this->user as $k => $v ): ?>
		<?php if( $k == 'additional' ): ?>
			<tr align="left">
				<th><?= $k ?></th>
				<td>
					<table class="table table-striped table-bordered">
						<?php $additional = json_decode( $v, $assoc = true ) ?: []; ?>
						<?php foreach($additional as $ka => $va): ?>
							<tr align="left">
								<th><?= $ka ?></th>
								<td><?= $va ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
				</td>
			</tr>
		<?php else: ?>
			<tr align="left">
				<th><?= $k ?></th>
				<td><?= $v ?></td>
			</tr>
		<?php endif; ?>
	<?php endforeach; ?>
</table>
