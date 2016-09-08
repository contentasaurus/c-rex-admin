<ol class="breadcrumb">
	<?php foreach( $this->crumbs as $crumb ): ?>
		<?php if( !isset($crumb['active']) || !$crumb['active'] ): ?>
			<li class="breadcrumb-item"><a href="<?= $crumb['url'] ?>"><?= $crumb['name'] ?></a></li>
		<?php else: ?>
			<li class="breadcrumb-item active"><?= $crumb['name'] ?></li>
		<?php endif; ?>
	<?php endforeach; ?>
</ol>
