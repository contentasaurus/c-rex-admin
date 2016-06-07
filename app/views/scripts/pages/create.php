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
						<select class="form-control required" name="page_type_id">
							<?php foreach( $this->page_types as $page_type ): ?>
								<option value="<?= $page_type['id'] ?>"><?= $page_type['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<select class="form-control required" name="page_status_id">
							<?php foreach( $this->page_statuses as $page_status ): ?>
								<option value="<?= $page_status['id'] ?>"><?= $page_status['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="form-group">
						<input placeholder="Name" class="form-control required" name="page_name" type="text">
					</div>

					<div class="form-group">
						<input placeholder="/my-permalink" class="form-control required" name="permalink" type="text">
					</div>

					<div class="form-group">
						<div id="editor" class="form-control"></div>
						<input type="hidden" name="page_content" id="page_content">
					</div>

				</div>

				<footer class="panel-footer">
					<div class="pull-right">
						<a class="btn btn-default" href="/pages">Cancel</a>
						<button class="btn btn-primary" type="submit">Create</button>
					</div>
				</footer>

			</form>

		</section>
	</div>
</div>
