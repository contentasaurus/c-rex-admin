<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="/pages">Pages</a></li>
	<li class="breadcrumb-item"><a href="/pages/update/<?= $this->page['id'] ?>/data">Data</a></li>
	<li class="breadcrumb-item active">Update Data</li>
</ol>

<form method="POST" accept-charset="UTF-8" datatypes-form-ajax="">
	<div class="card">
		<div class="card-header">
			Update Page Data
		</div>
		<div class="card-block">
			<input name="id" type="hidden" value="<?= $this->page_data['id'] ?>">
			<input name="datatype_id" type="hidden" value="<?= $this->datatype['id'] ?>">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label class="control-label">Reference Name</label>
				<input placeholder="Reference Name" class="form-control required" id="reference_name" name="reference_name" type="text" value="<?= $this->page_data['reference_name'] ?>">
			</div>

			<div class="form-group">
				<label class="control-label">Datatype</label>
				<p class="form-control form-control-static" ><?= $this->datatype['name'] ?></p>
			</div>

		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<?= ucwords($this->datatype['name']) ?> Inputs
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
