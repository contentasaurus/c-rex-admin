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
								<i class="fa fa-envelope"></i>
							</div>
							<input class="form-control" type="text" name="email" placeholder="Email Address" value="" />
						</div>
					</div>
					<div class="form-group text-xs-center">
						<button type="submit" class="btn btn-lg btn-success">
							Request reset
						</button>
					</div>
				</form>
			</div>
		</div>
		<div class="text-xs-center">
			<a href="/auth/login/" class="btn btn-link text-muted">Back to Login</a>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#body').addClass('login');
</script>
