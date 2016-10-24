<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Datatypes', 'url' => '/datatypes'  ],
	[ 'name'=> 'Update Site Data', 'active' => 'true'  ],
]]); ?>

<form method="POST" accept-charset="UTF-8" datatypes-form-ajax="">
	<div class="card">
		<div class="card-header">
			Site.<?= $this->datatype['name'] ?> Inputs
		</div>
		<div class="card-block">

			<input name="id" type="hidden" value="<?= $this->site_data['id'] ?>">

			<div id="form-render"></div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Save</button>
				<a class="btn btn-secondary" href="/datatypes">Cancel</a>
			</div>

		</div>
	</div>
</form>

<script>
	$(function(){
		var container = document.getElementById('form-render');
		$(container).formRender({
			dataType: "json",
			container: container,
			formData: '<?= $this->datatype['content'] ?>'
		});

		function fill(a)
		{
			for(var k in a){
				$('[name="'+k+'"]').val(a[k]);
			}
		}

		fill(<?= $this->site_data['content'] ?>);
	});
</script>
