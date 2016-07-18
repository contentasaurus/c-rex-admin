<ol class="breadcrumb">
  <li><a href="/components">Components</a></li>
  <li class="active">Create Component</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<section class="panel panel-default">
			<header class="panel-heading">
				<h3 class="panel-title">Create Component</h3>
			</header>
			<form method="POST" accept-charset="UTF-8" data-form-ajax="">
				<div class="panel-body">

					<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

					<div class="form-group">
						<input placeholder="Name" class="form-control required" name="name" type="text">
					</div>
					<div class="form-group">
						<textarea placeholder="Description" class="form-control" name="description"></textarea>
					</div>
					<div class="form-group">
						<div id="editor" class="form-control"><?= htmlentities('<code>') ?></div>
						<input type="hidden" name="content" id="content">
					</div>

				</div>

				<footer class="panel-footer">
					<div class="pull-right">
						<a class="btn btn-default" href="/components">Cancel</a>
						<button class="btn btn-primary" type="submit">Create</button>
					</div>
				</footer>

			</form>

		</section>
	</div>
</div>

<?php echo $this->partial('components/ace') ?>
