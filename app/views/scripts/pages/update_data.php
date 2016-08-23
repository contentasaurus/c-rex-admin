<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/pages">Pages</a></li>
	<li class="breadcrumb-item active">Update Page</li>
</ol>

<div class="card">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs pull-xs-left">
			<li class="nav-item">
				<a class="nav-link" href="/pages/update/<?= $this->page['id'] ?>">Contents</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="/pages/update/<?= $this->page['id'] ?>/data">Data</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/pages/update/<?= $this->page['id'] ?>/status">Status</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/pages/update/<?= $this->page['id'] ?>/history">History</a>
			</li>
		</ul>
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="page_id" type="hidden" value="<?= $this->page['id'] ?>">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label>Reference Name</label>
				<input class="form-control" name="reference_name" type="text" value="">
			</div>

			<div class="form-group">
				<label>Data Type</label>
				<select class="form-control required" name="datatype_id">
					<option>--Choose a type--</option>
					<?php foreach( $this->datatypes as $datatype ): ?>
						<option value="<?= $datatype['id'] ?>"><?= $datatype['name'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Add</button>
				<a class="btn btn-secondary" href="/pages">Cancel</a>
			</div>

		</form>
	</div>
</div>

<div class="card">
	<div class="card-header">
		Page Data
	</div>
	<?php if( !empty($this->page_data) ): ?>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th width="50"><br /></th>
					<th>Reference Name</th>
					<th>By</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->page_data as $data ): ?>
					<tr>
						<td>
							<a href="/pages/update/<?= $this->page['id'] ?>/data/update/<?= $data['id'] ?>" class="btn btn-secondary btn-sm">
								<i class="fa fa-pencil"></i>
							</a>
						</td>
						<td><?= $data['reference_name'] ?></td>
						<td><?= $data['first_name'] ?> <?= $data['last_name'] ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="card-block">
			<div class="card-block">
				<blockquote class="card-blockquote">
					This page has no data objects associated with it.
				</blockquote>
			</div>
		</div>
	<?php endif; ?>
</div>
