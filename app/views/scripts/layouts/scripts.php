<?php use \puffin\transformer as transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Layouts', 'url' => '/layouts'  ],
	[ 'name'=> 'Update Layout', 'active' => 'true'  ],
]]); ?>


<div class="card">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs float-xs-left">
			<li class="nav-item">
				<a class="nav-link" href="/layouts/update/<?= $this->layout['id'] ?>">Contents</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="/layouts/update/<?= $this->layout['id'] ?>/scripts">Scripts</a>
			</li>
		</ul>
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input type="hidden" name="page_layout_id" value="<?= $this->layout['id'] ?>">
			<div class="card-deck-wrapper">
				<div class="card-deck">
					<?php foreach($this->scripts as $group => $scripts): ?>
						<div class="card">
							<div class="card-header">
								<div class="card-title"><?= $group ?></div>
							</div>
							<div class="card-block">
								<ul id="sortable-<?= $group ?>" class="sortable list-group">
									<?php foreach( $scripts as $script ): ?>
										<li class="list-group-item form-check">
											<?php if( $script['load_order'] != "null" ): ?>
												<h3 class="tag tag-pill tag-default"><?= $script['load_order'] ?></h3>
											<?php else: ?>
												<h3 class="tag tag-pill tag-default" style="visibility:hidden">0</h3>
											<?php endif; ?>
											<label class="form-check-label">
												&nbsp;
												<input
													<?php if( in_array($script['id'], $this->layout_script_ids )): ?>checked="checked"<?php endif; ?>
													class="form-check-input"
													type="checkbox" name="script[<?= $script['type_name'] ?>][]"
													value="<?= $script['id'] ?>" />
												<?= $script['name'] ?>
											</label>
											<i class="float-xs-right text-muted fa fa-bars sortable-handle"></i>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Save</button>
				<a class="btn btn-secondary" href="/layouts">Cancel</a>
			</div>
		</form>
	</div>
</div>

<style>
	.sortable-handle {
		cursor: move;
	}
</style>

<script>
	$(function(){
		<?php foreach($this->scripts as $group => $scripts): ?>
			Sortable.create( document.getElementById('sortable-<?= $group ?>'), {
				handle: '.sortable-handle',
				ghostClass: 'list-group-item-info',
				chosenClass: "active",
				fallbackClass: "list-group-item",
				scroll: true
			});
		<?php endforeach; ?>
	});
</script>
