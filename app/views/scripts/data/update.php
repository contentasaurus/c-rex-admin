<ol class="breadcrumb">
  <li><a href="/data">Data</a></li>
  <li class="active">Update Data</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<section class="panel panel-default">
			<header class="panel-heading">
				<h3 class="panel-title">Update Data</h3>
			</header>
			<form method="POST" accept-charset="UTF-8" data-form-ajax="">
				<div class="panel-body">

					<input name="id" type="hidden" value="<?= $this->data['id'] ?>">

					<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

					<div class="form-group">
						<label class="control-label" for="data_name">Name</label>
						<input placeholder="Name" class="form-control required" id="name" name="name" type="text" value="<?= $this->data['name'] ?>">
					</div>
					<div class="form-group">
						<label class="control-label">Data</label>
						<div id="editor" class="form-control"><?= htmlentities($this->data['data']) ?></div>
						<input type="hidden" name="data" id="data">
					</div>
				</div>

				<footer class="panel-footer">
					<button class="btn btn-primary" type="submit">Save</button>
					<a class="btn btn-default" href="/data">Cancel</a>
				</footer>

			</form>

		</section>
	</div>
</div>

<?php echo $this->partial('data/ace') ?>
