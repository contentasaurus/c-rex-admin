<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Layouts', 'url' => '/layouts'  ],
	[ 'name'=> 'Create Script', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		Create Script
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">
			<div class="form-group">
				<label>Name</label>
				<input placeholder="Name" class="form-control required" name="name" type="text">
			</div>
			<div class="form-group">
				<label>Type</label>
				<select name="script_type_id" id="script_type_id" class="form-control required" >
					<option value="">Choose a type</option>
					<?php foreach( $this->script_types as $type ): ?>
						<option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Content</label>
				<div id="editor" class="form-control"><?= htmlentities('<code>') ?></div>
				<input type="hidden" name="html" id="content">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Create</button>
				<a class="btn btn-secondary" href="/layouts">Cancel</a>
			</div>
		</form>
	</div>
</div>

<?php echo $this->partial('scripts/ace',[ 'script_types' => $this->script_types ]); ?>
