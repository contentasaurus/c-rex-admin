<ol class="breadcrumb">
  <li><a href="/blocks">Blocks</a></li>
  <li class="active">Update Block</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<section class="panel panel-default">
			<header class="panel-heading">
				<h3 class="panel-title">Update Block</h3>
			</header>
			<form method="POST" accept-charset="UTF-8" data-form-ajax="">
				<div class="panel-body">

					<input name="id" type="hidden" value="<?= $this->block['id'] ?>">

					<div class="form-group">
						<input placeholder="Name" class="form-control required" name="name" type="text" value="<?= $this->block['name'] ?>">
					</div>
					<div class="form-group">
						<textarea placeholder="Description" class="form-control" name="description"><?= $this->block['description'] ?></textarea>
					</div>
					<div class="form-group">
						<div id="editor" class="form-control"><?= htmlentities($this->block['content']) ?></div>
						<input type="hidden" name="content" id="content">
					</div>

				</div>

				<footer class="panel-footer">
					<div class="pull-right">
						<a class="btn btn-default" href="/blocks">Cancel</a>
						<button class="btn btn-primary" type="submit">Update</button>
					</div>
				</footer>

			</form>

		</section>
	</div>
</div>

<?php echo $this->partial('blocks/ace') ?>
