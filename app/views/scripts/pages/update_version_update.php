<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Pages', 'url' => '/pages' ],
	[ 'name'=> 'Versions', 'url' => "/pages/update/{$this->page['id']}/versions" ],
	[ 'name'=> 'Update Version', 'active' => 'true' ],
]]); ?>

<div class="card">
	<div class="card-header">
		<?= $this->partial('tabs', [ 'classes' => 'card-header-tabs pull-xs-left', 'tabs' => [
			[ 'name'=> 'Contents', 'url' => "/pages/update/{$this->page['id']}" ],
			[ 'name'=> 'Versions', 'active' => 'active', 'url' => "/pages/update/{$this->page['id']}/versions" ],
			[ 'name'=> 'Data', 'url' => "/pages/update/{$this->page['id']}/data" ],
			[ 'name'=> 'Status', 'url' => "/pages/update/{$this->page['id']}/status" ],
			[ 'name'=> 'History', 'url' => "/pages/update/{$this->page['id']}/history" ]
		]]); ?>
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="id" type="hidden" value="<?= $this->page_version['id'] ?>">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label>Title</label>
				<input placeholder="Name" class="input-lg form-control required" name="page_name" type="text" value="<?= $this->page_version['page_name'] ?>">
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
			<div id="editor" class="form-control"><?= htmlentities($this->page_version['page_content']) ?></div>
			<input type="hidden" name="page_content" id="content">
			<br />

			<button type="submit" class="btn btn-primary">Save</button>
			<a class="btn btn-secondary" href="/pages/update/{$this->page['id']}/versions">Cancel</a>
		</form>
	</div>
</div>

<?php echo $this->partial('pages/ace') ?>
