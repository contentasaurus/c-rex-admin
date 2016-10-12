<?php
	use \puffin\controller;
	use puffin\transformer;
?>

<style>
	.nav-label{
		display: none;
	}

	/*#nav-primary a:hover .nav-label {
		display: inline;
	}*/
</style>

<nav id="nav-primary">
	<ul>
		<li>
			<a href="/" <?php if( controller::$controller == 'index' ): ?>class="active"<?php endif; ?>>
				<img class="img-rounded avatar" src="<?= transformer::gravatar( $_SESSION['user']['email'], false ) ?>" width="56" />
				<br /><span class="nav-label">Me</span>
			</a>
			<ul>
				<li>
					<a href="/users/profile" <?php if( controller::$controller == 'users' && controller::$action == 'profile' ): ?>class="list-group-item-info"<?php endif; ?>>
						My Profile
					</a>
				</li>
				<li>
					<a href="/about" <?php if( controller::$controller == 'index' && controller::$action == 'about' ): ?>class="list-group-item-info"<?php endif; ?>>
						About
					</a>
				</li>
				<li>
					<div class="dropdown-divider"></div>
				</li>
				<li>
					<a href="/auth/logout">
						Logout
					</a>
				</li>
			</ul>
		</li>

		<li>
			<a href="/pages" <?php if( controller::$controller == 'pages' ): ?>class="active"<?php endif; ?> data-toggle="tooltip" data-placement="right" title="Pages">
				<i class="fa fa-sitemap fa-2x"></i><br/><span class="nav-label">Pages</span>
			</a>
		</li>
		<li>
			<a href="/layouts" <?php if( controller::$controller == 'layouts' ): ?>class="active"<?php endif; ?> data-toggle="tooltip" data-placement="right" title="Layouts">
				<i class="fa fa-desktop fa-2x"></i><br/><span class="nav-label">Layouts</span>
			</a>
		</li>
		<li>
			<a href="/components" <?php if( controller::$controller == 'components' ): ?>class="active"<?php endif; ?> data-toggle="tooltip" data-placement="right" title="Components">
				<i class="fa fa-cube fa-2x"></i><br/><span class="nav-label">Components</span>
			</a>
		</li>
		<li>
			<a href="/datatypes" <?php if( controller::$controller == 'datatypes' ): ?>class="active"<?php endif; ?> data-toggle="tooltip" data-placement="right" title="Datatypes">
				<i class="fa fa-database fa-2x"></i><br/><span class="nav-label">Datatypes</span>
			</a>
		</li>
		<!-- <li>
			<a href="/helpers" <?php if( controller::$controller == 'helpers' ): ?>class="active"<?php endif; ?> data-toggle="tooltip" data-placement="right" title="Helpers">
				<i class="fa fa-thumbs-o-up fa-2x"></i><br/><span class="nav-label">Helpers</span>
			</a>
		</li> -->

		<li>
			<hr />
		</li>
		<li>
			<a href="/deploy" <?php if( controller::$controller == 'deploy' ): ?>class="active"<?php endif; ?> data-toggle="tooltip" data-placement="right" title="Deploy">
				<i class="fa fa-cloud-upload fa-2x"></i><br/><span class="nav-label">Deploy</span>
			</a>
		</li>
		<li>
			<a href="/users" <?php if( controller::$controller == 'users' && controller::$action != 'profile' ): ?>class="active"<?php endif; ?> data-toggle="tooltip" data-placement="right" title="Users">
				<i class="fa fa-users fa-2x"></i><br/><span class="nav-label">Users</span>
			</a>
		</li>
	</ul>
</nav>

<script>
$(function(){
	$('#nav-primary a').tooltip();
})
</script>
