<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Datatypes', 'url' => '/datatypes'  ],
	[ 'name'=> 'Create Site Data', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		Create Site Data
	</div>
	<div class="card-block">
		<form id="add_form" method="POST" accept-charset="UTF-8" data-form-ajax="">

			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label>Key</label>
				<input class="form-control" name="reference_name" id="reference_name" type="text" value="">
				<div class="hidden form-control-feedback" id="reference_name_feedback"></div>
				<p class="form-text text-muted">
					Your key must not begin with a number, and must not contain spaces, special characters (except underscore).
				</p>
			</div>

			<div class="form-group">
				<label>Type</label>
				<select class="form-control required" name="datatype_id" id="datatype_id">
					<option value="null">--Choose a type--</option>
					<?php foreach( $this->datatypes as $datatype ): ?>
						<option value="<?= $datatype['id'] ?>"><?= $datatype['name'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">Add</button>
				<a class="btn btn-secondary" href="/datatypes">Cancel</a>
			</div>

		</form>
	</div>
</div>

<script>
	$(function(){
		var regex = /^[a-zA-Z_][a-zA-Z0-9_]*$/;

		$('#reference_name').on('keypress', function(event){
			var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
			if( !/^[a-zA-Z0-9_]*$/.test(key) )
			{
				event.preventDefault();
				return false;
			}
		});

		$('form#add_form').on('submit',function(){
			var ref_name = $('#reference_name');
			var ref_feedback = $('#reference_name_feedback');
			var datatype_id = $('#datatype_id');

			var key = ref_name.val();
			ref_name.removeClass('form-control-warning');
			ref_name.parent('.form-group').removeClass('has-warning');
			ref_feedback.addClass('hidden');

			var fail = 0;

			if( key )
			{
				if( !regex.test(key) )
				{
					ref_name.addClass('form-control-warning');
					ref_name.parent('.form-group').addClass('has-warning');
					ref_feedback.html('The key value contains invalid characters, or begins with a number.');
					ref_feedback.removeClass('hidden');
					fail++;
				}
				else
				{
					ref_name.addClass('form-control-success');
					ref_name.parent('.form-group').addClass('has-success');
				}
			}
			else
			{
				ref_name.addClass('form-control-warning');
				ref_name.parent('.form-group').addClass('has-warning');
				ref_feedback.html('The key value is required.');
				ref_feedback.removeClass('hidden');
				fail++;
			}

			if( !datatype_id.val() || datatype_id.val() == 'null' )
			{
				datatype_id.addClass('form-control-warning');
				datatype_id.parent('.form-group').addClass('has-warning');
				fail++;
			}
			else
			{
				datatype_id.addClass('form-control-success');
				datatype_id.parent('.form-group').addClass('has-success');
			}

			if( fail > 0)
			{
				event.preventDefault();
				return false;
			}
		})
	});
</script>
