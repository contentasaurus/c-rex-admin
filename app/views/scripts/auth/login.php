<div class="container">

	<div class="col-md-4 col-center">
		<div id="logo" align="center">
			<img src="/img/atl-puff.svg" width="150" />
		</div>
		<div class="panel panel-default">
			<div class="panel-heading"><span class="icon-lock"> Login</span></div>
			<div class="panel-body">

				<?php if( false ): ?>
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						Please check the form below for errors
					</div>
				<?php endif; ?>

				<?php if( false ): ?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						message
					</div>
				<?php endif; ?>
				
				<form id="login-form" method="post">
					<div class="form-group">
						<input class="form-control" type="text" name="email" placeholder="Email Address" value="" />
					</div>
					<div class="form-group">
						<input class="form-control required" type="password" name="password" placeholder="password" value="" />
					</div>
					<div class="form-group last">
						<div class="col-sm-offset-3 col-sm-9">
							<button type="submit" class="btn btn-success btn-md">Login</button>
							<a href="/auth/login" class="btn btn-default btn-md">Reset</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#body').addClass('login');
</script>

<script type="text/javascript" src="{{ URL::to('js/admin.js') }}"></script>
