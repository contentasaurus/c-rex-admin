<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Deploy', 'url' => '/deploy'  ],
	[ 'name'=> 'Test Datasource', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		Test Results
	</div>
	<?php if( is_array($this->test_results) ): ?>
		<div class="card-block">
			<div class="card card-inverse card-success text-xs-center">
				<div class="card-block">
					<blockquote class="card-blockquote">
						<i class="fa fa-thumbs-up"></i><br />
						Connection successful! Database summary below.
					</blockquote>
				</div>
			</div>
		</div>
		<?php foreach($this->test_results as $table_name => $tables): ?>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>
							Tables in <?= $this->dbname ?>
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
		<div class="card-block">
			<div class="card card-inverse card-danger text-xs-center">
				<div class="card-block">
					<blockquote class="card-blockquote">
						<i class="fa fa-thumbs-down"></i><br />
						<?= $this->test_results ?>
					</blockquote>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>

<a href="/deploy" class="btn btn-primary">OK</a>
