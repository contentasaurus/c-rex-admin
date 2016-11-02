<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Datatypes', 'url' => '/datatypes'  ],
	[ 'name'=> 'Update Datatype', 'active' => 'true'  ],
]]); ?>

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

			<?php #echo $this->partial('form/builder'); ?>

			<div class="form-group">
				<label class="control-label">Content</label>
				<div id="editor" class="form-control"><?= htmlentities($this->datatype['content']) ?></div>
				<input type="hidden" name="content" id="content">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Save</button>
				<a class="btn btn-secondary" href="/datatypes">Cancel</a>
			</div>

		</form>

		<div class="form-group">
			<div class="form-builder"></div>
		</div>

	</div>
</div>

<?php echo $this->partial('datatypes/ace') ?>
