<?php
	namespace puffin;
	use \puffin\transformer as transformer;
?>

<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/layouts">Layouts</a></li>
	<li  class="breadcrumb-item active">Update Layout</li>
</ol>

<div class="card">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs pull-xs-left">
			<li class="nav-item">
				<a class="nav-link active" href="/layouts/update/<?= $this->layout['id'] ?>">Contents</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/layouts/update/<?= $this->layout['id'] ?>/scripts">Scripts</a>
			</li>
		</ul>
	</div>
	<div class="card-block">
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

			<div class="form-group">
				<label>Content</label>
				<div id="editor" class="form-control"><?= htmlentities($this->layout['content']) ?></div>
				<input type="hidden" name="content" id="content">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Save</button>
				<a class="btn btn-secondary" href="/layouts">Cancel</a>
			</div>
		</form>
	</div>
</div>

<?php echo $this->partial('layouts/ace') ?>
