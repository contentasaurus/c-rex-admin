<ol class="breadcrumb">
  <li><a href="/collections">Collections</a></li>
  <li class="active">Delete Collection</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-5">
		<section class="panel panel-danger">
			<header class="panel-heading">
				<h3 class="panel-title">Delete Collection</h3>
			</header>
			<form method="post" accept-charset="UTF-8">
				<input type="hidden" name="id" value="<?= $this->collection['id'] ?>">

				<div class="panel-body">
					<div align="center">
						<span class="material-icons md-72">delete_forever</span>
						<p>Are you sure you want to delete this collection? This cannot be undone.</p>

						<?php if( empty($this->collection['collection_data']) ): ?>
							<div class="alert alert-info">Empty Collection</div>
						<?php else: ?>
							<table class="table table-striped table-bordered">
								<?php foreach($this->collection['collection_data'] as $k => $v): ?>
									<tr align="left">
										<th><?= $k ?></th>
										<td><?= $v ?></td>
									</tr>
								<?php endforeach; ?>
							</table>
						<?php endif; ?>
					</div>
				</div>

				<footer class="panel-footer">
					<div class="pull-right">
						<a class="btn btn-default" href="/collections">Cancel</a>
						<button class="btn btn-primary" type="submit">Confirm Delete</button>
					</div>
				</footer>

			</form>

		</section>
	</div>
</div>
