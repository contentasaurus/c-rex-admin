<?php use puffin\transformer as transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Components', 'url' => '/components' ],
	[ 'name'=> 'Update Components', 'active' => 'true' ],
]]); ?>

<div class="card">
	<div class="card-header">
		<?= $this->partial('tabs', [ 'classes' => 'card-header-tabs float-xs-left', 'tabs' => [
			[ 'name'=> 'HTML', 'url' => "/components/update/{$this->component['id']}" ],
			[ 'name'=> 'SCSS', 'url' => "/components/update/{$this->component['id']}/css" ],
			[ 'name'=> 'JS-Head', 'url' => "/components/update/{$this->component['id']}/javascript" ],
			[ 'name'=> 'JS-Body', 'active' => 'active', 'url' => "/components/update/{$this->component['id']}/nonblocking-javascript" ],
		]]); ?>
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="id" type="hidden" value="<?= $this->component['id'] ?>">

			<div class="form-group">
				<label>Name</label>
				<input placeholder="Name" class="form-control required" name="name" type="text" value="<?= $this->component['name'] ?>">
			</div>
			<div class="form-group">
				<label>Description</label>
				<textarea placeholder="Description" class="form-control" name="description"><?= $this->component['description'] ?></textarea>
			</div>

			<div class="form-group">
				<label>Wrapper</label>
				<p class="form-control">
					<?php $uuid = $this->component['uuid']; ?>
					(function(uuid){
						/* content */
					})( "<?= $uuid ?>" );
				</p>
			</div>

			<div class="form-group">
				<label>Content</label>
				<div id="js_editor" class="form-control ace_editor"><?= htmlentities($this->component['nonblocking_js']) ?></div>
				<input type="hidden" name="nonblocking_js" id="js">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Save</button>
				<a class="btn btn-secondary" href="/components">Cancel</a>
			</div>

		</form>
	</div>
</div>

<?php echo $this->partial('components/ace_javascript') ?>
