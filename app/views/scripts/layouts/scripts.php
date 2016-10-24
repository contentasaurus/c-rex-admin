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
			<input type="hidden" name="action" value="script_add">

			<label for="add_script_select">Add Script(s)</label>
			<div class="form-group">
				<select id="add_script_select" name="page_script_ids[]" multiple="multiple" class="form-control">
					<?php foreach($this->scripts as $group => $scripts): ?>
						<optgroup label="<?= $group ?>">
							<?php foreach( $scripts as $script ): ?>
								<option <?php if( in_array($script['id'], $this->layout_script_ids )): ?>disabled="disabled"<?php endif; ?> value="<?= $script['id'] ?>"><?= $script['name'] ?></option>
							<?php endforeach; ?>
						</optgroup>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Add</button>
			</div>
		</form>
	</div>
</div>

<form method="POST" accept-charset="UTF-8" data-form-ajax="">
	<input type="hidden" name="page_layout_id" value="<?= $this->layout['id'] ?>">
	<input type="hidden" name="action" value="script_order">
		<?php foreach($this->layout_scripts as $group => $scripts): ?>
			<div id="section-<?= transformer::safeslug($group, $to_lowercase = true) ?>" class="card <?php if( empty($scripts) ): ?>hidden<?php endif; ?>">
				<div class="card-block">
					<div class="card-title"><?= $group ?></div>
					<ul class="sortable list-group list-group-flush">
						<?php foreach( $scripts as $script ): ?>
							<li class="list-group-item clearfix list-group-item-action" style="cursor:move">
								<input type="hidden" name="script[<?= $script['script_type_id'] ?>][]" value="<?= $script['script_id'] ?>" />
								<div class="pull-xs-left">
									<i class="fa fa-sort fa-fw" aria-hidden="true"></i> <?= $script['name'] ?>
								</div>
								<button type="button" class="remove-script-action btn btn-outline-danger btn-sm pull-xs-right">
									<i class="fa fa-remove" aria-hidden="true"></i>
								</button>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<?php endforeach; ?>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Save</button>
				<a class="btn btn-secondary" href="/layouts">Cancel</a>
			</div>
		</form>
	</div>
</div>

<script>
$(function(){
	$( "ul.sortable" ).sortable();

	$(document).on("click",".remove-script-action", function( event ){

		let $length = $( event.target ).closest("ul").has("li").length - 1;

		if( !$length ){
			$( event.target ).closest(".panel").remove();
		}
		else {
			$( event.target ).closest("li").remove();
		}
	});

	$('#add_script_select').chosen({
		'width':'600px'
	});

});
</script>
