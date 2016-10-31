<?php
	$fields = [
		"hidden" => [
			"type" => ["hidden","hidden"],
			"required" => [
				"name" => "text",
				"default" => "text"
			]
		],
		"text" => [
			"type" => ["hidden","text"],
			"required" => [
				"label" => "text",
				"name" => "text"
			],
			"optional" => [
				"class" => "text",
				"placeholder" => "text",
				"default" => "text",
				"required" => "checkbox",
				"min" => "number",
				"max" => "number",
				"pattern" => "text"
			]
		],
		"number" => [
			"type" => ["hidden","number"],
			"required" => [
				"name" => "text",
				"label" => "text"
			],
			"optional" => [
				"class" => "text",
				"placeholder" => "text",
				"default" => "number",
				"required" => "checkbox",
				"min" => "number",
				"max" => "number",
				"step" => "number"
			]
		],
		"color" => [
			"type" => ["hidden","color"],
			"required" => [
				"name" => "text",
				"label" => "text"
			],
			"optional" => [
				"class" => "text",
				"default" => "color",
				"required" => "checkbox"
			]
		],
		"fieldset" => [
			"type" => ["hidden","fieldset"],
			"optional" => [
				"class" => "text",
				"legend" => "text"
			],
			"required" => [
				"name" => "text"
			]
		],
		"h_repeater" => [
			"type" => ["hidden","repeater"],
			"direction" => ["hidden","horizontal"],
			"required" => [
				"name" => "text",
				"label" => "text"
			],
			"optional" => [
				"class" => "text",
			]
		],
		"v_repeater" => [
			"type" => ["hidden","repeater"],
			"direction" => ["hidden","vertical"],
			"required" => [
				"name" => "text",
				"label" => "text"
			],
			"optional" => [
				"class" => "text",
			]
		],
		"date" => [
			"type" => ["hidden","date"],
			"required" => [
				"name" => "text",
				"label" => "text"
			],
			"optional" => [
				"class" => "text",
				"placeholder" => "text",
				"default" => "date",
				"required" => "checkbox",
				"min" => "date",
				"max" => "date"
			]
		],
		"email" => [
			"type" => ["hidden","email"],
			"required" => [
				"name" => "text",
				"label" => "text"
			],
			"optional" => [
				"class" => "text",
				"placeholder" => "text",
				"default" => "text",
				"required" => "checkbox",
				"pattern" => "text"
			]
		],
		"radio" => [
			"type" => ["hidden","radio"],
			"required" => [
				"name" => "text"
			],
			"optional" => [
				"class" => "text",
				"required" => "checkbox"
			],
			"options" => [
				"checked" => "radio",
				"value" => "text",
				"label" => "text"
			]
		],
		"select" => [
			"type" => ["hidden","select"],
			"multiple" => ["hidden","false"],
			"optional" => [
				"class" => "text",
				"required" => "false"
			],
			"required" => [
				"name" => "text",
				"label" => "text"
			],
			"options" => [
				"selected" => "radio",
				"value" => "text",
				"text" => "text"
			]
		],
		"multiselect" => [
			"type" => ["hidden","select"],
			"multiple" => ["hidden","true"],
			"optional" => [
				"class" => "text",
				"required" => "false"
			],
			"required" => [
				"name" => "text",
				"label" => "text"
			],
			"options" => [
				"selected" => "checkbox",
				"value" => "text",
				"text" => "text"
			]
		],
		"checkbox" => [
			"type" => ["hidden","checkbox"],
			"required" => [
				"name" => "text"
			],
			"optional" => [
				"class" => "text",
				"required" => "checkbox"
			],
			"options" => [
				"checked" => "checkbox",
				"value" => "text",
				"label" => "text"
			]
		],
		"textarea" => [
			"type" => ["hidden","textarea"],
			"required" => [
				"name" => "text",
				"label" => "text"
			],
			"optional" => [
				"class" => "text",
				"placeholder" => "text",
				"default" => "textarea",
				"required" => "checkbox",
				"rows" => "number"
			]
		],
	];
?>

<div class="form-group">
	<div class="builder-wrapper">
		<ul id="builder-fields" class="list-group builder-fields">
			<?php foreach( $fields as $fieldname => $field ): ?>
				<?php if( in_array( $fieldname, ['v_repeater','h_repeater', 'fieldset'] ) ): ?>
					<li class="builder-handle builder-repeater-handle list-group-item">
						<div class="builder-handle-title">
							<div class="builder-handle-name">
								<button class="edit-li btn btn-secondary btn-sm" type="button">
									<i class="fa fa-pencil"></i>
								</button>
								<?= $fieldname ?>
							</div>
							<div class="builder-handle-action">
								<button class="remove-li btn btn-sm btn-danger" type="button">
									<i class="fa fa-close"></i>
								</button>
							</div>
						</div>
						<ul class="builder-repeater-dropzone"></ul>
					</li>
				<?php else: ?>
					<li class="builder-handle list-group-item">
						<div class="builder-handle-title">
							<div class="builder-handle-name">
								<button class="edit-li btn btn-secondary btn-sm" type="button">
									<i class="fa fa-pencil"></i>
								</button>
								<?= $fieldname ?>
							</div>
							<div class="builder-handle-action">
								<button class="remove-li btn btn-sm btn-danger" type="button">
									<i class="fa fa-close"></i>
								</button>
							</div>
						</div>
						<div class="builder-form-fields">
							<?php foreach( $field as $attribute => $structure ): ?>
								<?php if( in_array($attribute, ['optional','required']) ): ?>
									<?php if( $attribute == 'required' ){
										$asterisk = "*";
										$required = "required";
									} else {
										$asterisk = "";
										$required = "";
									} ?>
									<?php foreach( $structure as $attr => $value ): ?>
										<?php switch( $attr ):
											case "hidden": ?>
												<input class="form-control" type="<?= $value[0] ?>" name="<?= $attribute ?>" value="<?= $value[1] ?>">
												<?php break; ?>
											<?php case "checkbox": ?>
											<?php case "radio": ?>
												<?php break; ?>
											<?php case "select": ?>
											<?php case "multiselect": ?>
												<?php break; ?>
											<?php case "textarea": ?>
												<div class="form-group row">
													<label class="col-form-label col-xs-2"><?= $attr ?><?= @$asterisk ?></label>
													<div class="col-xs-4">
														<textarea class="form-control" <?= @$required ?> name="<?= $attr ?>"></textarea>
													</div>
												</div>
												<?php break; ?>
											<?php default: ?>
												<div class="form-group row">
													<label class="col-form-label col-xs-2"><?= $attr ?><?= @$asterisk ?></label>
													<div class="col-xs-4">
														<input class="form-control" <?= @$required ?> type="<?= $value ?>" name="<?= $attr ?>" value="">
													</div>
												</div>
												<?php break; ?>
										<?php endswitch; ?>

									<?php endforeach; ?>

								<?php else: ?>
									<?php $type = reset($structure) ?: ''; ?>
									<?php $value = end($structure) ?: ''; ?>
									<input class="form-control" type="<?= $type ?>" name="<?= $attribute ?>" value="<?= $value ?>">
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<ul id="builder-dropzone" class="builder-dropzone">
		</ul>

		<style>
			.builder-wrapper {
				display:flex;
				flex-direction:row;
				align-items:stretch;
				width:100%
			}
			.builder-fields {
				display:flex;
				flex-direction:column;
			}

			.builder-fields .builder-form-fields{
				display:none;
			}

			.builder-repeater-dropzone.droppable .builder-form-fields,
			.builder-dropzone .builder-form-fields{;
				clear:both;
				/*display:none;*/
			}

			.builder-handle-title .edit-li{
				display:none;
				clear:both;
			}

			.builder-handle-action{
				display:none;
			}

			.builder-dropzone{
				margin:0;
				padding:12px;
				background-color:#ccc;
				border:1px dashed #333;
				display:flex;
				flex-direction:column;
				width:100%;
			}

			.builder-repeater-dropzone.droppable{
				margin:0;
				margin-top:2em;
				padding:12px;
				background-color:#ccc;
				border:1px dashed #333;
				display:flex;
				flex-direction:column;
				width:100%;
			}

			.builder-repeater-dropzone.droppable .builder-handle-title .edit-li,
			.builder-dropzone .builder-handle-title .edit-li{
				display:inline;
			}

			.builder-repeater-dropzone.droppable .builder-handle-title,
			.builder-dropzone .builder-handle-title{
				line-height: 1.5em;
				clear:both;
			}

			.builder-repeater-dropzone.droppable .builder-handle-name,
			.builder-dropzone .builder-handle-name{
				float:left;
				display:block;
			}

			.builder-repeater-dropzone.droppable .builder-handle-action,
			.builder-dropzone .builder-handle-action{
				float:right;
				display:block;
			}
		</style>
	</div>
</div>

<script>
	$(function(){
		Sortable.create( document.getElementById('builder-fields'), {
			group: { name: "fields", pull: "clone" },
			sort: false,
			handle: '.builder-handle',
			ghostClass: 'list-group-item-info',
			fallbackClass: "list-group-item",
			scroll: true
		});

		Sortable.create( document.getElementById('builder-dropzone'), {
			group: { name: 'builder-dropzone',  put: ['fields']},
			handle: '.builder-handle',
			ghostClass: 'list-group-item-info',
			fallbackClass: "list-group-item",
			scroll: true,
			onAdd: function ( evt ) {
				var itemEl = evt.item;  // dragged HTMLElement
				evt.from;  // previous list

				if( $(itemEl).has('ul').length === 1 ){
					var jq = $(itemEl).children('ul');
					Sortable.create( jq[0], {
						group: { name: 'builder-repeater-dropzone',  put: ['fields']},
						handle: '.builder-handle',
						ghostClass: 'list-group-item-info',
						fallbackClass: "list-group-item",
						scroll: true,
						onAdd: function (evt) {
							var item = evt.item;  // dragged HTMLElement
							evt.from;  // previous list
							if( $(item).hasClass('builder-repeater-handle') ){
								item.parentNode.removeChild(item); // remove sortable item
							}
						}
					}),
					$(itemEl).children('ul.builder-repeater-dropzone').addClass('droppable')
				}
			}
		});

	});
</script>
