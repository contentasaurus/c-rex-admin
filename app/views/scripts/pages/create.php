<ol class="breadcrumb">
  <li><a href="/pages">Pages</a></li>
  <li class="active">Create Page</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<section class="panel panel-default">
			<header class="panel-heading">
				<h3 class="panel-title">Create Page</h3>
			</header>
			<form method="POST" accept-charset="UTF-8" data-form-ajax="">
				<div class="panel-body">

					<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

					<div class="form-group">
						<label>Page Title</label>
						<input placeholder="Name" class="input-lg form-control required" name="page_name" type="text">
					</div>

					<div class="form-group">
						<label>Permalink</label>
						<input placeholder="/my-permalink" class="form-control required" name="permalink" type="text">
					</div>

					<div class="form-group">
						<label>Page Layout</label>
						<select class="form-control required" name="page_layout_id">
							<?php foreach( $this->page_layouts as $layout ): ?>
								<option value="<?= $layout['id'] ?>"><?= $layout['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<label>Page Status</label>
						<select class="form-control required" name="page_status_id">
							<?php foreach( $this->page_statuses as $page_status ): ?>
								<option value="<?= $page_status['id'] ?>"><?= $page_status['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>

				</div>

				<footer class="panel-footer">
					<button class="btn btn-primary" type="submit">Next</button>
					<a class="btn btn-default" href="/pages">Cancel</a>
				</footer>

			</form>

		</section>
	</div>
</div>
