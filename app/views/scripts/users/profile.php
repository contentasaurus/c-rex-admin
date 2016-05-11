<h1><span class="icon-account-circle"></span> Profile</h1>

<table class="table table-striped table-bordered">
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
