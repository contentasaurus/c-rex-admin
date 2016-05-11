<header id="header">
	<a href='/'>
		<div id="logo">
			Atlantic
		</div>
	</a>
	<nav id="user-profile">
		<div id="user-account"><span class="icon-account-circle"></span><?= $_SESSION['user']['first_name'] ?> <?= $_SESSION['user']['last_name'] ?></div>
		<ul>
			<li><a href="/users/profile">Account</a></li>
			<li><a href="/auth/logout">Logout</a></li>
		</ul>
	</nav>
</header>
