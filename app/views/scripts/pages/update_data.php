<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Pages', 'url' => '/pages' ],
	[ 'name'=> 'Update Page', 'active' => 'true' ],
]]); ?>

<div class="card">
	<div class="card-header">
		<?= $this->partial('tabs', [ 'classes' => 'card-header-tabs pull-xs-left', 'tabs' => [
			[ 'name'=> 'Contents', 'url' => "/pages/update/{$this->page['id']}" ],
			[ 'name'=> 'Versions', 'url' => "/pages/update/{$this->page['id']}/versions" ],
			[ 'name'=> 'Data', 'active' => 'active', 'url' => "/pages/update/{$this->page['id']}/data" ],
			[ 'name'=> 'Status', 'url' => "/pages/update/{$this->page['id']}/status" ],
			[ 'name'=> 'History', 'url' => "/pages/update/{$this->page['id']}/history" ]
		]]); ?>
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
