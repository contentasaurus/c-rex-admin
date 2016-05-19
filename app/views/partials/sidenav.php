<?php use \puffin\controller; ?>

<nav id="nav-primary">
	<ul>
		<li>
			<a href="/" <?php if( controller::$controller == 'index' ): ?>class="active"<?php endif; ?>>
				<!-- <span class="material-icons">home</span><br/>Welcome -->
				<img class="image-thumbnail" src="/img/atl-puff.svg" width="56" />
			</a>
		</li>
		<li>
			<a href="/media" <?php if( controller::$controller == 'media' ): ?>class="active"<?php endif; ?>>
				<span class="material-icons">image</span><br/>Media
			</a>
		</li>
		<li>
			<a href="/blocks" <?php if( controller::$controller == 'blocks' ): ?>class="active"<?php endif; ?>>
				<span class="material-icons">view_quilt</span><br/>Blocks
			</a>
		</li>
		<li>
			<a href="/collections" <?php if( controller::$controller == 'collections' ): ?>class="active"<?php endif; ?>>
				<span class="material-icons">view_list</span><br/>Collections
			</a>
		</li>

		<li>
			<a href="/pages" <?php if( controller::$controller == 'pages' ): ?>class="active"<?php endif; ?>>
				<span class="material-icons">pages</span><br/>Pages
			</a>
		</li>
		<li>
			<a href="/settings" <?php if( controller::$controller == 'settings' ): ?>class="active"<?php endif; ?>>
				<span class="material-icons">library_books</span><br/>Site Settings
			</a>
		</li>
		<li>
			<a href="/users" <?php if( controller::$controller == 'users' && controller::$action != 'profile' ): ?>class="active"<?php endif; ?>>
				<span class="material-icons">people</span><br/>Users
			</a>
		</li>
		<li>
			<a href="/users/profile" <?php if( controller::$controller == 'users' && controller::$action == 'profile' ): ?>class="active"<?php endif; ?>>
				<span class="material-icons">face</span><br/>My Profile
			</a>
		</li>
		<li>
			<a href="/auth/logout">
				<span class="material-icons">exit_to_app</span><br/>Logout
			</a>
		</li>
	</ul>
</nav>
