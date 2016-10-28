<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Pages', 'url' => '/pages' ],
	[ 'name'=> 'Page', 'url' => "/pages/update/{$this->page['id']}" ],
	[ 'name'=> 'Update Data', 'active' => 'true' ],
]]); ?>

<form method="POST" accept-charset="UTF-8" datatypes-form-ajax="">
	<input type="hidden" name="datatype_id" value="<?= $this->datatype['id'] ?>" />
	<div class="card">
		<div class="card-header">
			Page.<?= $this->page_data['reference_name'] ?>
		</div>
		<div class="card-block">

			<?php
				foreach( $this->datatype['content'] as $name => $tag )
				{
					if( isset($this->page_data['content'][$name]) && !empty($this->page_data['content'][$name]) )
					{
						$user_value = $this->page_data['content'][$name];
					}
					else
					{
						$user_value = NULL;
					}
					echo $this->partial("form/element", [ 'name' => $name, 'tag' => $tag, 'user_value' => $user_value ] );
				}
			?>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Save</button>
				<a class="btn btn-secondary" href="/pages/update/<?= $this->page['id'] ?>/data">Cancel</a>
			</div>

		</div>
	</div>
</form>
