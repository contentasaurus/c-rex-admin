<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Helpers', 'url' => '/helpers'  ],
	[ 'name'=> 'Update', 'active' => 'true'  ],
]]); ?>


<div class="card">
	<div class="card-header">
		Update Helper
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="id" type="hidden" value="<?= $this->helper['id'] ?>">

			<div class="form-group">
				<input placeholder="Name" class="form-control required" name="name" type="text" value="<?= $this->helper['name'] ?>">
			</div>
			<div class="form-group">
				<textarea placeholder="Description" class="form-control" name="description"><?= $this->helper['description'] ?></textarea>
			</div>

			<div class="form-group">
				<div id="editor" class="form-control ace_editor"><?= htmlentities($this->helper['content']) ?></div>
				<input type="hidden" name="content" id="content">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Save</button>
				<a class="btn btn-default" href="/helpers">Cancel</a>
			</div>

		</form>
	</div>
</div>

<?php echo $this->partial('helpers/ace') ?>
