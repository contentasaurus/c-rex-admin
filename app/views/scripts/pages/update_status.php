<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Pages', 'url' => '/pages' ],
	[ 'name'=> 'Update Page', 'active' => 'true' ],
]]); ?>

<div class="card">
	<div class="card-header">
		<?= $this->partial('tabs', [ 'classes' => 'card-header-tabs pull-xs-left', 'tabs' => [
			[ 'name'=> 'Contents', 'url' => "/pages/update/{$this->page['id']}" ],
			[ 'name'=> 'Versions', 'url' => "/pages/update/{$this->page['id']}/versions" ],
			[ 'name'=> 'Data', 'url' => "/pages/update/{$this->page['id']}/data" ],
			[ 'name'=> 'Status', 'active' => 'active', 'url' => "/pages/update/{$this->page['id']}/status" ],
			[ 'name'=> 'History', 'url' => "/pages/update/{$this->page['id']}/history" ]
		]]); ?>
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="id" type="hidden" value="<?= $this->page['id'] ?>">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="row">
				<div class="col-lg-5">
					<div class="form-group">
						<label>Current Status</label>
						<p class="form-control form-control-static"><?= $this->page['page_status'] ?></p>
					</div>
				</div>
				<div class="col-lg-1">
					<label><br /></label>
					<p class="form-control-static text-center">&rarr;</p>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label>Change Status to</label>
						<select class="form-control required" name="page_status_id">
							<option>--Choose a status--</option>
							<?php foreach( $this->page_statuses as $page_status ): ?>
								<option <?php if( $page_status['id'] == $this->page['page_status_id'] ): ?>disabled<?php endif ?> value="<?= $page_status['id'] ?>"><?= $page_status['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="form-group">
						<label>Comment</label>
						<textarea class="form-control required" name="comment"></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Change Status</button>
						<a class="btn btn-secondary" href="/pages">Cancel</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="card">
	<div class="card-header">
		Previous Changes
	</div>
	<?php if( !empty($this->page_logs) ): ?>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Date</th>
					<th>By</th>
					<th>Action</th>
					<th>Comment</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->page_logs as $log ): ?>
					<tr>
						<td><?= $log['created_at'] ?></td>
						<td><?= $log['first_name'] ?> <?= $log['last_name'] ?></td>
						<td>
							<span class="tag tag-default"><?= $log['prev_page_status'] ?></span>
							 &rarr;
							 <span class="tag tag-default"><?= $log['new_page_status'] ?></span>
						 </td>
						<td><?= $log['comment'] ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="card-block">
			<div class="card-block">
				<blockquote class="card-blockquote">
					This page has never had a status change.
				</blockquote>
			</div>
		</div>
	<?php endif; ?>
</div>
