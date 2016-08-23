<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/components">Components</a></li>
	<li class="breadcrumb-item active">Update Components</li>
</ol>

<div class="card">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs pull-xs-left">
			<li class="nav-item">
				<a class="nav-link" href="/components/update/<?= $this->component['id'] ?>">HTML</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="/components/update/<?= $this->component['id'] ?>/css">CSS</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/components/update/<?= $this->component['id'] ?>/javascript">JavaScript</a>
			</li>
		</ul>
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="id" type="hidden" value="<?= $this->component['id'] ?>">

			<div class="form-group">
				<input placeholder="Name" class="form-control required" name="name" type="text" value="<?= $this->component['name'] ?>">
			</div>
			<div class="form-group">
				<textarea placeholder="Description" class="form-control" name="description"><?= $this->component['description'] ?></textarea>
			</div>

			<div class="form-group">
				<div id="css_editor" class="form-control ace_editor"><?= htmlentities($this->component['css']) ?></div>
				<input type="hidden" name="css" id="css">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Save</button>
				<a class="btn btn-default" href="/components">Cancel</a>
			</div>

		</form>
	</div>
</div>

<?php echo $this->partial('components/ace_css') ?>
