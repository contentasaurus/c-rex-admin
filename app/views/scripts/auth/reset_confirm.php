<div class="container">
	<div class="col-md-4 col-center">

		<div class="card card-outline-info">
			<div class="card-header card-primary">
				<img class="m-x-auto d-block" src="/theme/img/temp-crex-logo.png" width="150" />
			</div>
			<div class="card-block">
				<form id="login-form" method="post">
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-key"></i>
							</div>
							<input class="form-control required" type="password" name="password" placeholder="new password" value="" />
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-repeat"></i>
							</div>
							<input class="form-control required" type="password" name="password_confirm" placeholder="please confirm" value="" />
						</div>
					</div>
					<div class="form-group text-xs-center">
						<button type="submit" class="btn btn-lg btn-success">
							Reset
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#body').addClass('login');
</script>
