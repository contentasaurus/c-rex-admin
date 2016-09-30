<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Deploy', 'url' => '/deploy'  ],
	[ 'name'=> 'Test', 'active' => 'true'  ],
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
						Datasource Connection Successful!
					</blockquote>
				</div>
			</div>

			<?php if( $this->test_results['table_create_test']['errorCode'] == '0000' ): ?>
				<div class="card card-inverse card-success text-xs-center">
					<div class="card-block">
						<blockquote class="card-blockquote">
							<i class="fa fa-thumbs-up"></i><br />
							Table Creation Successful!
						</blockquote>
					</div>
				</div>
			<?php else: ?>
				<div class="card card-inverse card-danger text-xs-center">
					<div class="card-block">
						<blockquote class="card-blockquote">
							<i class="fa fa-thumbs-up"></i><br />
							Table Creation Error!
							<?= $this->test_results['table_create_test']['errorInfo'][2] ?>
						</blockquote>
					</div>
				</div>
			<?php endif; ?>

			<?php if( $this->test_results['view_create_test']['errorCode'] == '0000' ): ?>
				<div class="card card-inverse card-success text-xs-center">
					<div class="card-block">
						<blockquote class="card-blockquote">
							<i class="fa fa-thumbs-up"></i><br />
							View Creation Successful!
						</blockquote>
					</div>
				</div>
			<?php else: ?>
				<div class="card card-inverse card-danger text-xs-center">
					<div class="card-block">
						<blockquote class="card-blockquote">
							<i class="fa fa-thumbs-up"></i><br />
							View Creation Error!
							<?= $this->test_results['view_create_test']['errorInfo'][2] ?>
						</blockquote>
					</div>
				</div>
			<?php endif; ?>

			<?php if( $this->test_results['table_delete_test']['errorCode'] == '0000' ): ?>
				<div class="card card-inverse card-success text-xs-center">
					<div class="card-block">
						<blockquote class="card-blockquote">
							<i class="fa fa-thumbs-up"></i><br />
							Table Deletion Successful!
						</blockquote>
					</div>
				</div>
			<?php else: ?>
				<div class="card card-inverse card-danger text-xs-center">
					<div class="card-block">
						<blockquote class="card-blockquote">
							<i class="fa fa-thumbs-up"></i><br />
							Table Deletion Error!
							<?= $this->test_results['table_delete_test']['errorInfo'][2] ?>
						</blockquote>
					</div>
				</div>
			<?php endif; ?>

			<?php if( $this->test_results['view_delete_test']['errorCode'] == '0000' ): ?>
				<div class="card card-inverse card-success text-xs-center">
					<div class="card-block">
						<blockquote class="card-blockquote">
							<i class="fa fa-thumbs-up"></i><br />
							View Deletion Successful!
						</blockquote>
					</div>
				</div>
			<?php else: ?>
				<div class="card card-inverse card-danger text-xs-center">
					<div class="card-block">
						<blockquote class="card-blockquote">
							<i class="fa fa-thumbs-up"></i><br />
							View Deletion Error!
							<?= $this->test_results['view_delete_test']['errorInfo'][2] ?>
						</blockquote>
					</div>
				</div>
			<?php endif; ?>
		</div>

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
