<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="/datatypes">Datatypes</a></li>
  <li class="breadcrumb-item active">Create Datatype</li>
</ol>

<div class="card">
	<div class="card-header">
		Create Datatype
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label>Name</label>
				<input placeholder="Name" class="form-control required" name="name" type="text">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Next</button>
				<a class="btn btn-default" href="/datatypes">Cancel</a>
			</div>
		</form>
	</div>
</div>
