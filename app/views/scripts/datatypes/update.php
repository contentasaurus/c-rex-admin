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
			<input type="hidden" name="content" id="content">

			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label class="control-label" for="datatypes_name">Name</label>
				<input placeholder="Name" class="form-control required" id="name" name="name" type="text" value="<?= $this->datatype['name'] ?>">
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

<script>
	$(function(){
		var $formBuilder = $('.form-builder').formBuilder({
			formData: '<?= json_encode(json_decode($this->datatype['content'], $assoc = true)) ?>',
			controlPosition: 'left',
			dataType: 'json',
			showActionButtons: false,
			stickyControls: true,
			disableFields: [
				'autocomplete',
				'file',
				'button',
				'date'
			]
		});

		$('form').on('submit', function(ev){
			$('input#content').val( $formBuilder.data('formBuilder').formData );
		});
	});
</script>

<style>
	.form-elements .className-wrap,
	.form-elements .access-wrap{
	  display:none;
	}
</style>
