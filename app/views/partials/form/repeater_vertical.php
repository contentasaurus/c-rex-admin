<fieldset class="form-group">
	<legend>
		<?= $this->tag['label'] ?>
	</legend>
	<div class="table-responsive">
		<table id="repeater_<?= $this->tag['name'] ?>" class="table table-bordered table-striped table-hover table-sm repeater">
			<thead>
				<tr>
					<th>Elements</th>
					<th width="50">
						<button id="add_to_repeater_<?= $this->tag['name'] ?>" type="button" class="btn btn-secondary btn-sm"><i class="fa fa-plus"></i></button>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php if( !empty($this->tag['user_value'])): ?>
					<?php foreach($this->tag['user_value'] as $index => $user_values): ?>
						<tr>
							<td>
								<?php foreach( $this->tag['fields'] as $name => $tag ): ?>

									<?php
										$params = [
											'name' => $name,
											'tag' => $tag,
											'repeater_name' => $this->tag['name'],
											'user_value' => @$user_values[$name]
										]
									?>
									<?= $this->partial("form/repeater_vertical/element", $params ); ?>
								<?php endforeach; ?>
							</td>
							<td width="50">
								<div class="btn-group" role="group">
									<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
										<i class="fa fa-close"></i>
									</button>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="repeater-remove-row dropdown-item" href="#">Confirm</a>
									</div>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		<table id="repeater_<?= $this->tag['name'] ?>_clone_row" style="display:none">
			<tbody>
				<tr>
					<td>
						<?php foreach( $this->tag['fields'] as $name => $tag ): ?>
							<?php
								$params = [
									'name' => $name,
									'tag' => $tag,
									'repeater_name' => $this->tag['name'],
									'user_value' => ''
								]
							?>
							<?= $this->partial("form/repeater_vertical/element", $params ); ?>
						<?php endforeach; ?>
					</td>
					<td width="50">
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-close"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="repeater-remove-row dropdown-item" href="#">Confirm</a>
							</div>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</fieldset>
<script>
$(function(){
	var clone_selector = '#repeater_<?= $this->tag['name'] ?>_clone_row tbody';
	var clone_row = $(clone_selector).html();
	$(clone_selector).remove();

	$("#add_to_repeater_<?= $this->tag['name'] ?>").on('click',function(){
		$('table#repeater_<?= $this->tag['name'] ?> tbody').append( clone_row );
	});

	$(document).on('click', '.repeater-remove-row', function(){
		$(this).closest('tr').remove();
	});
});
</script>
