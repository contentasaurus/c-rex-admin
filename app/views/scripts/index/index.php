<h1><span class="icon-dashboard"></span> Dashboard</h1>

<table class="table table-striped table-bordered">
	<?php foreach( $_SESSION['user'] as $k => $v ): ?>
		<tr align="left">
			<th><?= $k ?></th>
			<td><?= $v ?></td>
		</tr>
	<?php endforeach; ?>
	<tr>
		<th align="left">Is_Owner</th>
		<td><?= $this->is_owner ? 'true' : 'false' ?></td>
	</tr>
	<tr>
		<th align="left">Is_Editor</th>
		<td><?= $this->is_editor ? 'true' : 'false' ?></td>
	</tr>
	<tr>
		<th align="left">Is_Author</th>
		<td><?= $this->is_author ? 'true' : 'false' ?></td>
	</tr>
	<tr>
		<th align="left">Is_disabled</th>
		<td><?= $this->is_disabled ? 'true' : 'false' ?></td>
	</tr>
</table>
