<ol class="breadcrumb">
  <li><a href="/build">Build</a></li>
  <li class="active">Add Datasource</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">

			<div class="form-group">
				<label>Name</label>
				<input placeholder="Name" class="form-control required" name="name" type="text" value="">
			</div>

			<input name="db_type" type="hidden" value="mysql">

			<div class="form-group">
				<label>DB Name</label>
				<input placeholder="atlantic_db" class="form-control required" name="db_name" type="text" value="">
			</div>

			<div class="form-group">
				<label>DB User</label>
				<input placeholder="atlantic_db_user" class="form-control required" name="db_user" type="text" value="">
			</div>

			<div class="form-group">
				<label>DB Password</label>
				<input placeholder="hunter2" class="form-control required" name="db_password" type="text" value="">
			</div>

			<div class="form-group">
				<label>DB Address</label>
				<input placeholder="127.0.0.1" class="form-control required" name="db_address" type="text" value="">
			</div>

			<br />

			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="submit" class="btn btn-primary navbar-btn">Add</button>
						<a class="btn btn-default navbar-btn" href="/build">Cancel</a>
					</div>
				</div>
			</nav>
		</form>
	</div>
</div>
