<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Pages', 'url' => '/pages' ],
	[ 'name'=> 'Page', 'url' => "/pages/update/{$this->page['id']}" ],
	[ 'name'=> 'Update Data', 'active' => 'true' ],
]]); ?>

<form method="POST" accept-charset="UTF-8" datatypes-form-ajax="">
	<div class="card">
		<div class="card-header">
			Page.<?= $this->datatype['name'] ?> Inputs
		</div>
		<div class="card-block">

			<input name="id" type="hidden" value="<?= $this->page_data['id'] ?>">

			<div id="form-render"></div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Save</button>
				<a class="btn btn-secondary" href="/pages/update/<?= $this->page['id'] ?>/data">Cancel</a>
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


		$('form').populate(<?= $this->page_data['content'] ?>, {
			identifier : 'name'
		});
	});
</script>
