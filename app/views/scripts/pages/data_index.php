<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Pages', 'url' => '/pages' ],
	[ 'name'=> 'Update Page', 'active' => 'true' ],
]]); ?>

<div class="card">
	<div class="card-header">
		<?= $this->partial('tabs', [ 'classes' => 'card-header-tabs pull-xs-left', 'tabs' => [
			[ 'name'=> 'Contents', 'url' => "/pages/update/{$this->page['id']}" ],
			[ 'name'=> 'Data', 'active' => 'active', 'url' => "/pages/update/{$this->page['id']}/data" ]
		]]); ?>
	</div>
	<div class="card-block">
		<form id="add_form" method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="page_id" type="hidden" value="<?= $this->page['id'] ?>">
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
				<a class="btn btn-secondary" href="/pages">Cancel</a>
			</div>

		</form>
	</div>
</div>

<div class="card">
	<div class="card-header">
		Global Data
	</div>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Key</th>
					<th>Type</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Get</td>
					<td>GET data</td>
				</tr>
				<tr>
					<td>Post</td>
					<td>POST data</td>
				</tr>
				<tr>
					<td>Session</td>
					<td>SESSION data</td>
				</tr>
				<tr>
					<td>Server</td>
					<td>SERVER data</td>
				</tr>
			</tbody>
		</table>
</div>

<div class="card">
	<div class="card-header">
		Page Data
	</div>
	<?php if( !empty($this->page_data) ): ?>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th width="50"><br /></th>
					<th>Key</th>
					<th>Type</th>
					<th>By</th>
					<th>Last Updated</th>
					<th width="50"><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->page_data as $data ): ?>
					<tr>
						<td>
							<a href="/pages/update/<?= $this->page['id'] ?>/data-update/<?= $data['id'] ?>" class="btn btn-secondary btn-sm">
								<i class="fa fa-pencil"></i>
							</a>
						</td>
						<td>Data.<?= $data['reference_name'] ?></td>
						<td><?= $data['datatype_name'] ?></td>
						<td><?= $data['first_name'] ?> <?= $data['last_name'] ?></td>
						<td><?= $data['updated_at'] ?></td>
						<td>
							<?= $this->partial('delete', [
								'url' => "/pages/update/{$this->page['id']}/data-delete/{$data['id']}",
								'id' => $data['id'],
							]); ?>
						</td>

					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="card-block">
			<div class="card-block">
				<blockquote class="card-blockquote">
					This page has no data objects associated with it.
				</blockquote>
			</div>
		</div>
	<?php endif; ?>
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


<script>
	$(function(){
		$('[data-toggle="popover"]').popover();
	});
</script>