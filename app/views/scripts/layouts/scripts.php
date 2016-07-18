<?php
	namespace puffin;
	use \puffin\transformer as transformer;
?>

<ol class="breadcrumb">
	<li><a href="/layouts">Layouts</a></li>
	<li class="active">Update Layout</li>
</ol>

<div class="container-fluid">
	<div class="col-lg-10">

		<ul class="nav nav-tabs">
			<li role="presentation"><a href="/layouts/update/<?= $this->layout['id'] ?>">Content</a></li>
			<li role="presentation" class="active"><a href="#">Scripts</a></li>
		</ul>
		<br />
		<!-- Tab panes -->
		<form method="POST" accept-charset="UTF-8" data-form-ajax="" class="form-inline">
			<input type="hidden" name="page_layout_id" value="<?= $this->layout['id'] ?>">
			<input type="hidden" name="action" value="script_add">

			<div class="panel panel-default">
				<div class="panel-body">
					<label for="add_script_select">Script(s)</label>
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
						<button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
					</div>
				</div>
			</div>
		</form>
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input type="hidden" name="page_layout_id" value="<?= $this->layout['id'] ?>">
			<input type="hidden" name="action" value="script_order">

			<?php foreach($this->layout_scripts as $group => $scripts): ?>
				<section id="section-<?= transformer::safeslug($group, $to_lowercase = true) ?>" class="panel panel-default <?php if( empty($scripts) ): ?>hidden<?php endif; ?>">
					<header class="panel-heading">
						<h3 class="panel-title"><?= $group ?></h3>
					</header>
					<div class="panel-body">
						<ul class="sortable list-group">
							<?php foreach( $scripts as $script ): ?>
								<li class="list-group-item">
									<input type="hidden" name="script[<?= $script['script_type_id'] ?>][]" value="<?= $script['script_id'] ?>" />
									<div class="pull-left">
										<i class="fa fa-sort fa-fw" aria-hidden="true"></i> <?= $script['name'] ?>
									</div>
									<button type="button" class="remove-script-action btn btn-danger btn-xs pull-right"><i class="fa fa-remove fa-fw" aria-hidden="true"></i></button>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</section>
			<?php endforeach; ?>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="submit" class="btn btn-primary navbar-btn">Save</button>
						<a class="btn btn-default navbar-btn" href="/layouts">Cancel</a>
					</div>
				</div>
			</nav>
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
