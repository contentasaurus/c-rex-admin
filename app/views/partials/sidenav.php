<?php use \puffin\controller; ?>

<nav id="nav-primary">
	<ul>
		<li>
			<a href="/" <?php if( controller::$controller == 'index' ): ?>class="active"<?php endif; ?>>
				<img class="image-thumbnail" src="/theme/img/atl-puff.svg" width="56" />
			</a>
		</li>
		<li>
			<a href="/media" <?php if( controller::$controller == 'media' ): ?>class="active"<?php endif; ?>>
				<i class="fa fa-picture-o fa-2x"></i><br/>Media
			</a>
		</li>
		<li>
			<a <?php if( in_array(controller::$controller, ['components','datatypes','layouts']) ): ?>class="active"<?php endif; ?>>
				<i class="fa fa-cube fa-2x"></i><br/>Content
			</a>
			<ul>
				<li>
					<a href="/components" <?php if( controller::$controller == 'components' ): ?>class="list-group-item-info"<?php endif; ?>>
						Components
					</a>
				</li>
				<li>
					<a href="/datatypes" <?php if( controller::$controller == 'datatypes' ): ?>class="list-group-item-info"<?php endif; ?>>
						Datatypes
					</a>
				</li>
				<li>
					<a href="/layouts" <?php if( controller::$controller == 'layouts' ): ?>class="list-group-item-info"<?php endif; ?>>
						Layouts
					</a>
				</li>
				<li>
					<a href="/scripts" <?php if( controller::$controller == 'scripts' ): ?>class="list-group-item-info"<?php endif; ?>>
						Scripts
					</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="/pages" <?php if( controller::$controller == 'pages' ): ?>class="active"<?php endif; ?>>
				<i class="fa fa-sitemap fa-2x"></i><br/>Pages
			</a>
		</li>
		<li>
			<a href="/deploy" <?php if( controller::$controller == 'deploy' ): ?>class="active"<?php endif; ?>>
				<i class="fa fa-database fa-2x"></i><br/>Deploy
			</a>
		</li>
		<li>
			<a href="/users" <?php if( controller::$controller == 'users' && controller::$action != 'profile' ): ?>class="active"<?php endif; ?>>
				<i class="fa fa-users fa-2x"></i><br/>Users
			</a>
		</li>
		<li>
			<a href="/users/profile" <?php if( controller::$controller == 'users' && controller::$action == 'profile' ): ?>class="active"<?php endif; ?>>
				<i class="fa fa-user fa-2x"></i><br/>Profile
			</a>
		</li>
		<li>
			<a href="/auth/logout">
				<i class="fa fa-sign-out fa-2x"></i><br/>Logout
			</a>
		</li>
	</ul>
</nav>
