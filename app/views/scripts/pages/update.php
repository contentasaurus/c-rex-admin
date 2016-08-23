<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/pages">Pages</a></li>
	<li class="breadcrumb-item active">Update Page</li>
</ol>

<div class="card">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs pull-xs-left">
			<li class="nav-item">
				<a class="nav-link active" href="/pages/update/<?= $this->page['id'] ?>">Contents</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/pages/update/<?= $this->page['id'] ?>/data">Data</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/pages/update/<?= $this->page['id'] ?>/status">Status</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/pages/update/<?= $this->page['id'] ?>/history">History</a>
			</li>
		</ul>
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="id" type="hidden" value="<?= $this->page['id'] ?>">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label>Title</label>
				<input placeholder="Name" class="input-lg form-control required" name="page_name" type="text" value="<?= $this->page['page_name'] ?>">
			</div>
			<div class="form-group">
				<label>Permalink</label>
				<input placeholder="/my-permalink" class="form-control required" name="permalink" type="text" value="<?= $this->page['permalink'] ?>">
			</div>
			<div class="form-group">
				<label>Page Layout</label>
				<select class="form-control required" name="page_layout_id">
					<?php foreach( $this->page_layouts as $layout ): ?>
						<option value="<?= $layout['id'] ?>"><?= $layout['name'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<label>Content</label>
			<div id="editor" class="form-control"><?= htmlentities($this->page['page_content']) ?></div>
			<input type="hidden" name="page_content" id="content">
			<br />

			<button type="submit" class="btn btn-primary">Save</button>
			<a class="btn btn-secondary" href="/pages">Cancel</a>
		</form>
	</div>
</div>

<?php echo $this->partial('pages/ace') ?>
