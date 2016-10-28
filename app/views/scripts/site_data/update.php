<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Datatypes', 'url' => '/datatypes'  ],
	[ 'name'=> 'Update Site Data', 'active' => 'true'  ],
]]); ?>

<form method="POST" accept-charset="UTF-8" datatypes-form-ajax="">
	<input type="hidden" name="datatype_id" value="<?= $this->datatype['id'] ?>" />
	<div class="card">
		<div class="card-header">
			Site.<?= $this->site_data['reference_name'] ?>
		</div>
		<div class="card-block">

			<?php
				foreach( $this->datatype['content'] as $name => $tag )
				{
					if( isset($this->site_data['content'][$name]) && !empty($this->site_data['content'][$name]) )
					{
						$user_value = $this->site_data['content'][$name];
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
				<a class="btn btn-secondary" href="/datatypes">Cancel</a>
			</div>

		</div>
	</div>
</form>
