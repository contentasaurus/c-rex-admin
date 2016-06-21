<ol class="breadcrumb">
  <li><a href="/pages">Pages</a></li>
  <li class="active">Update Page</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<section class="panel panel-default">
				<header class="panel-heading">
					<h3 class="panel-title">Update Page</h3>
				</header>
				<div class="panel-body">
					<div class="form-group">
						<input placeholder="Name" class="input-lg form-control required" name="page_name" type="text" value="<?= $this->page['page_name'] ?>">
					</div>
					<div class="form-group">
						<input placeholder="/my-permalink" class="form-control required" name="permalink" type="text" value="<?= $this->page['permalink'] ?>">
					</div>

					<div class="form-group">
						<select class="form-control required" name="page_type_id">
							<?php foreach( $this->page_types as $page_type ): ?>
								<option <?php if( $this->page['page_type_id'] == $page_type['id'] ): ?>selected="selected"<?php endif; ?> value="<?= $page_type['id'] ?>"><?= $page_type['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

			</section>

			<section id="section_page_content" class="panel panel-primary">
				<header class="panel-heading">
					<div class="row">
						<div class="col-sm-2 pull-left">
							<h3 class="panel-title">Page Content</h3>
						</div>
						<div class="col-sm-2 pull-right">
							<a id="content_fullscreen_toggle" href="#" class="panel-title"><span class="material-icons">fullscreen</span></a>
						</div>
					</div>
				</header>
				<div class="panel-body">
					<div>
						<textarea name="page_content" id="page_content"></textarea>
					</div>
				</div>
			</section>

			<section class="panel panel-default">
				<header class="panel-heading">
					<h3 class="panel-title">Page Status</h3>
				</header>
				<div class="panel-body">
					<div class="form-group">
						<select class="form-control required" name="page_status_id">
							<?php foreach( $this->page_statuses as $page_status ): ?>
								<option <?php if( $this->page['page_status_id'] == $page_status['id'] ): ?>selected="selected"<?php endif; ?> value="<?= $page_status['id'] ?>"><?= $page_status['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label>Previous Changes</label>
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
											<td><?= $log['user_id'] ?></td>
											<td><?= $log['prev_page_status_id'] ?> -&gt; <?= $log['new_page_status_id'] ?></td>
											<td><?= $log['comment'] ?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						<?php else: ?>
							<div class="well">This page has never had a status change.</div>
						<?php endif; ?>
					</div>
				</div>
			</section>

			<section class="panel panel-default">
				<header class="panel-heading">
					<h3 class="panel-title">Page History</h3>
				</header>
				<div class="panel-body">
					<div class="form-group">
						<?php if( !empty($this->page_history) ): ?>
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Date</th>
										<th>By</th>
										<th><br /></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach( $this->page_history as $version ): ?>
										<tr>
											<td><?= $log['created_at'] ?></td>
											<td><?= $log['author_user_id'] ?></td>
											<td><button class="btn btn-xs btn-link"><span class="material-icons">pageview</span></button></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						<?php else: ?>
							<div class="well">This page has never been changed.</div>
						<?php endif; ?>
					</div>
				</div>
			</section>

			<section class="panel panel-default">
				<footer class="panel-footer">
					<div class="pull-right">
						<a class="btn btn-default" href="/pages">Cancel</a>
						<button class="btn btn-primary" type="submit">Update</button>
					</div>
				</footer>
			</section>

		</form>
	</div>
</div>

<?php echo $this->partial('pages/medium') ?>
