<?php use \puffin\controller; ?>

<nav id="nav-primary">
	<ul>
		<li>
			<a href="/" <?php if( controller::$controller == 'index' ): ?>class="active"<?php endif; ?>>
				<!-- <span class="material-icons">home</span><br/>Welcome -->
				<img class="image-thumbnail" src="/theme/img/atl-puff.svg" width="56" />
			</a>
		</li>
		<li>
			<a href="/media" <?php if( controller::$controller == 'media' ): ?>class="active"<?php endif; ?>>
				<span class="material-icons">image</span><br/>Media
			</a>
		</li>
		<li>
			<a <?php if( in_array(controller::$controller, ['components','data','articles','layouts']) ): ?>class="active"<?php endif; ?>>
				<span class="material-icons">view_quilt</span><br/>Content
			</a>
			<ul>
				<li>
					<a href="/articles" <?php if( controller::$controller == 'articles' ): ?>class="list-group-item-info"<?php endif; ?>>
						Articles
					</a>
				</li>
				<li>
					<a href="/components" <?php if( controller::$controller == 'components' ): ?>class="list-group-item-info"<?php endif; ?>>
						Components
					</a>
				</li>
				<li>
					<a href="/data" <?php if( controller::$controller == 'data' ): ?>class="list-group-item-info"<?php endif; ?>>
						Data
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
