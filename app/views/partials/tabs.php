<ul class="nav nav-tabs <?= $this->classes ?>">
	<?php foreach( $this->tabs as $tab ): ?>
		<li class="nav-item"><a class="nav-link <?= @$tab['active'] ?: '' ?>" href="<?= @$tab['url'] ?: '#' ?>"><?= @$tab['name'] ?: '' ?></a></li>
	<?php endforeach; ?>
</ul>
