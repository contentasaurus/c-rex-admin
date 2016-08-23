<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/scripts">Scripts</a></li>
	<li class="breadcrumb-item active">Update Script</li>
</ol>

<div class="card">
	<div class="card-header">
		Update Script
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="id" type="hidden" value="<?= $this->script['id'] ?>">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label>Name</label>
				<input placeholder="Name" class="form-control required" name="name" type="text" value="<?= $this->script['name'] ?>">
			</div>
			<div class="form-group">
				<label>Type</label>
				<select name="script_type_id" id="script_type_id" class="form-control required" >
					<option value="">Choose a type</option>
					<?php foreach( $this->script_types as $type ): ?>
						<option <?php if( $this->script['script_type_id'] == $type['id'] ): ?>selected="selected"<?php endif; ?> value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Content</label>
				<div id="editor" class="form-control"></div>
				<input type="hidden" name="html" id="content">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Save</button>
				<a class="btn btn-secondary" href="/scripts">Cancel</a>
			</div>
		</form>
	</div>
</div>

<?php echo $this->partial('scripts/ace',[ 'script_types' => $this->script_types, 'html' => $this->script['html'] ]); ?>
