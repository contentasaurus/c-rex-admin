<?php
	namespace puffin;
	use \puffin\transformer as transformer;
?>

<ol class="breadcrumb">
	<li><a href="/layouts">Layouts</a></li>
	<li class="active">Update Layout</li>
</ol>

<div class="container-fluid">
	<div class="col-lg-10">

		<ul class="nav nav-tabs">
			<li role="presentation" class="active"><a href="#">Content</a></li>
			<li role="presentation"><a href="/layouts/update/<?= $this->layout['id'] ?>/scripts">Scripts</a></li>
		</ul>
		<br />
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input type="hidden" name="id" value="<?= $this->layout['id'] ?>">

			<div class="form-group">
				<label>Name</label>
				<input placeholder="Name" class="form-control required input-lg" name="name" type="text" value="<?= $this->layout['name'] ?>">
			</div>
			<div class="form-group">
				<label>Description</label>
				<textarea placeholder="Description" rows="4" class="form-control" name="description"><?= $this->layout['description'] ?></textarea>
			</div>

			<div id="editor" class="form-control"><?= htmlentities($this->layout['content']) ?></div>
			<input type="hidden" name="content" id="content">
			<br />
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="submit" class="btn btn-primary navbar-btn">Save</button>
						<a class="btn btn-default navbar-btn" href="/layouts">Cancel</a>
					</div>
				</div>
			</nav>
		</form>
	</div>
</div>

<?php echo $this->partial('layouts/ace') ?>
