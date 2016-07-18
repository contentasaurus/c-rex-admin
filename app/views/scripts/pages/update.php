<ol class="breadcrumb">
	<li><a href="/pages">Pages</a></li>
	<li class="active">Update Page</li>
</ol>

<div class="container-fluid">
	<div class="col-lg-10">

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#tab_content" aria-controls="content" role="tab" data-toggle="tab">Contents</a></li>
			<li role="presentation"><a href="#tab_details" aria-controls="details" role="tab" data-toggle="tab">Status</a></li>
			<li role="presentation"><a href="#tab_history" aria-controls="history" role="tab" data-toggle="tab">History</a></li>
		</ul>
		<br />
		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="tab_content">
				<form method="POST" accept-charset="UTF-8" data-form-ajax="">
					<input name="id" type="hidden" value="<?= $this->page['id'] ?>">
					<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

					<div class="form-group">
						<label>Title</label>
						<input placeholder="Name" class="input-lg form-control required" name="page_name" type="text" value="<?= $this->page['page_name'] ?>">
					</div>
					<div class="form-group">
						<label>Permalink</label>
						<input placeholder="/my-permalink" class="form-control required" name="permalink" type="text" value="<?= $this->page['permalink'] ?>">
					</div>
					<div class="form-group">
						<label>Page Layout</label>
						<select class="form-control required" name="page_layout_id">
							<?php foreach( $this->page_layouts as $layout ): ?>
								<option value="<?= $layout['id'] ?>"><?= $layout['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<label>Content</label>
					<div id="editor" class="form-control"><?= htmlentities($this->page['page_content']) ?></div>
					<input type="hidden" name="page_content" id="content">
					<br />
					<nav class="navbar navbar-default">
						<div class="container-fluid">
							<div class="navbar-header">
								<button type="submit" class="btn btn-primary navbar-btn">Save</button>
								<a class="btn btn-default navbar-btn" href="/pages">Cancel</a>
							</div>
						</div>
					</nav>
				</form>
			</div>
			<div role="tabpanel" class="tab-pane" id="tab_details">
				<form method="POST" accept-charset="UTF-8" data-form-ajax="">
					<input name="id" type="hidden" value="<?= $this->page['id'] ?>">
					<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

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

					<nav class="navbar navbar-default">
						<div class="container-fluid">
							<div class="navbar-header">
								<button type="submit" class="btn btn-primary navbar-btn">Save</button>
								<a class="btn btn-default navbar-btn" href="/pages">Cancel</a>
							</div>
						</div>
					</nav>
				</form>
			</div>
			<div role="tabpanel" class="tab-pane" id="tab_history">
				<section class="panel panel-default">
					<header class="panel-heading">
						<h3 class="panel-title">Page History</h3>
					</header>
					<?php if( !empty($this->page_history) ): ?>
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th width="100">Action</th>
									<th width="200">Date</th>
									<th>Title</th>
									<th>Content</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach( $this->page_history as $version ): ?>
									<tr>
										<td>
											<a href="" class="btn btn-xs btn-link"><span class="material-icons">restore_page</span></a>
											<a href="/pages/version/delete/<?= $version['id'] ?>" class="btn btn-sm"><span class="material-icons md-18 danger">cancel</span></a>
										</td>
										<td><?= $version['created_at'] ?><br>by <?= $version['first_name'] ?> <?= $version['last_name'] ?></td>
										<td><?= $version['page_name'] ?></td>
										<td><?= nl2br($version['page_content']) ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php else: ?>
						<div class="panel-body">
							<div class="form-group">
								<div class="well">This page has never been changed.</div>
							</div>
						</div>
					<?php endif; ?>
				</section>
			</div>
		</div>
	</div>
</div>

<?php echo $this->partial('pages/ace') ?>
