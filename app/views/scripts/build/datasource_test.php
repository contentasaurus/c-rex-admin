<ol class="breadcrumb">
  <li><a href="/build">Build</a></li>
  <li class="active">Add Datasource</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<?php if( is_array($this->test_results) ): ?>
			<div class="well">
				Connection successful! Database summary below.
			</div>
			<?php foreach($this->test_results as $table_name => $tables): ?>
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>
								<?= $table_name ?>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach( $tables as $table ): ?>
							<tr>
								<td>
									<?= $table ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="well">
				<?= $this->test_results ?>
			</div>
		<?php endif; ?>

		<?php if( is_array($this->permissions) ): ?>
			<div class="well">
				Schema permission details below.
			</div>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>
							User Permissions
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($this->permissions as $privilege): ?>
						<tr>
							<td>
								<?= $privilege['PRIVILEGE_TYPE'] ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php else: ?>
			<div class="well">
				<?= $this->permissions ?>
			</div>
		<?php endif; ?>

		<a href="/build" class="btn btn-primary">OK</a>
	</div>
</div>
