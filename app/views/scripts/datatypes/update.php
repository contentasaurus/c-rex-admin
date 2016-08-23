<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/datatypes">Datatypes</a></li>
	<li class="breadcrumb-item active">Update Datatypes</li>
</ol>

<div class="card">
	<div class="card-header">
		Update Datatypes
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" datatypes-form-ajax="">

			<input name="id" type="hidden" value="<?= $this->datatype['id'] ?>">

			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label class="control-label" for="datatypes_name">Name</label>
				<input placeholder="Name" class="form-control required" id="name" name="name" type="text" value="<?= $this->datatype['name'] ?>">
			</div>
			<div class="form-group">
				<label class="control-label">Content</label>
				<div id="editor" class="form-control"><?= htmlentities($this->datatype['content']) ?></div>
				<input type="hidden" name="content" id="content">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Save</button>
				<a class="btn btn-default" href="/datatypes">Cancel</a>
			</div>

		</form>
	</div>
</div>

<?php echo $this->partial('datatypes/ace') ?>