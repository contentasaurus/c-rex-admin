<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Datatypes', 'url' => '/datatypes'  ],
	[ 'name'=> 'Update Datatype', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		Update Datatypes
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" datatypes-form-ajax="">

			<input name="id" type="hidden" value="<?= $this->datatype['id'] ?>">

			<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

			<div class="form-group">
				<label class="control-label" for="datatypes_name">Name</label>
				<input placeholder="Name" class="form-control required" id="name" name="name" type="text" value="<?= $this->datatype['name'] ?>">
			</div>

<?php
		/* ##########################
		$fields = [
			"hidden" => [
				"type" => "hidden",
				"required" => [
					"default" => "",
					"name" => ""
				]
			],
			"text" => [
				"type" => "text",
				"optional" => [
					"class" => "",
					"placeholder" => "",
					"default" => "",
					"required" => "false",
					"min" => "",
					"max" => "",
					"pattern" => ""
				],
				"required" => [
					"name" => "",
					"label" => ""
				]
			],
			"number" => [
				"type" => "number",
				"optional" => [
					"class" => "",
					"placeholder" => "",
					"default" => "",
					"required" => "false",
					"min" => "",
					"max" => "",
					"pattern" => "",
					"step" => ""
				],
				"required" => [
					"name" => "",
					"label" => ""
				]
			],
			"color" => [
				"type" => "color",
				"optional" => [
					"class" => "",
					"default" => "",
					"required" => "false",
					"min" => "",
					"max" => "",
					"pattern" => "",
					"step" => ""
				],
				"required" => [
					"name" => "",
					"label" => ""
				]
			],
			"fieldset" => [
				"type" => "fieldset",
				"optional" => [
					"class" => "",
					"label" => ""
				],
				"required" => [
					"name" => ""
				],
				"fields" => [

				]
			],
			"h_repeater" => [
				"type" => "repeater",
				"direction" => "horizontal",
				"optional" => [
					"class" => "",
				],
				"required" => [
					"name" => "",
					"label" => ""
				],
				"fields" => [

				]
			],
			"v_repeater" => [
				"type" => "repeater",
				"direction" => "vertical",
				"optional" => [
					"class" => "",
				],
				"required" => [
					"name" => "",
					"label" => ""
				],
				"fields" => [

				]
			],
			"date" => [
				"type" => "date",
				"optional" => [
					"class" => "",
					"placeholder" => "",
					"default" => "",
					"required" => "false",
					"min" => "",
					"max" => "",
					"pattern" => "",
					"step" => ""
				],
				"required" => [
					"name" => "",
					"label" => ""
				]
			],
			"email" => [
				"type" => "email",
				"optional" => [
					"class" => "",
					"placeholder" => "",
					"default" => "",
					"required" => "false",
					"min" => "",
					"max" => "",
					"pattern" => ""
				],
				"required" => [
					"name" => "",
					"label" => ""
				]
			],
			"radio" => [
				"type" => "radio",
				"optional" => [
					"class" => "",
					"default" => "",
					"required" => "false"
				],
				"required" => [
					"name" => "",
					"label" => ""
				],
				"options" => [

				]
			],
			"select" => [
				"type" => "select",
				"multiple" => "false",
				"optional" => [
					"class" => "",
					"default" => "",
					"required" => "false"
				],
				"required" => [
					"name" => "",
					"label" => ""
				],
				"options" => [

				]
			],
			"multiselect" => [
				"type" => "select",
				"multiple" => "true",
				"optional" => [
					"class" => "",
					"default" => "",
					"required" => "false",
				],
				"required" => [
					"name" => "",
					"label" => ""
				],
				"options" => [

				]
			],
			"checkbox" => [
				"type" => "checkbox",
				"optional" => [
					"class" => "",
					"required" => "false"
				],
				"required" => [
					"name" => "",
					"label" => ""
				],
				"options" => [

				]
			],
			"textarea" => [
				"type" => "textarea",
				"optional" => [
					"class" => "",
					"placeholder" => "",
					"default" => "",
					"required" => "false",
					"min" => "",
					"max" => "",
					"pattern" => "",
					"rows" => ""
				],
				"required" => [
					"name" => "",
					"label" => ""
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

					.builder-handle-title .edit-li{
						display:none;
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

<?php ########################## */ ?>

			<div class="form-group">
				<label class="control-label">Content</label>
				<div id="editor" class="form-control"><?= htmlentities($this->datatype['content']) ?></div>
				<input type="hidden" name="content" id="content">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Save</button>
				<a class="btn btn-secondary" href="/datatypes">Cancel</a>
			</div>

		</form>

		<div class="form-group">
			<div class="form-builder"></div>
		</div>

	</div>
</div>

<?php echo $this->partial('datatypes/ace') ?>
