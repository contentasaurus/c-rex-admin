<?php use puffin\transformer; ?>

<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="/media">Media</a></li>
</ol>

<div id="having" class="card">
	<div class="card-header">
		Image Filter(s)
	</div>
	<form method="get">
		<table class="table table-striped table-hover">
			<thead>
				<th width="200">Property</th>
				<th width="200">Operator</th>
				<th>Value</th>
				<th width="50">
					<a id="add_having_filter" class="btn btn-secondary">
						<i class="fa fa-plus"></i> Add
					</a>
				</th>
			</thead>
			<tbody>
				<tr>
					<td>Tags</td>
					<td>Include</td>
					<td>
						<select id="chosen-select" multiple class="form-control required" name="tags[]">
							<?php foreach( $this->tags as $tag ): ?>
								<option <?php if( in_array($tag['id'], $this->selected_tags) ): ?>selected="selected"<?php endif; ?> value="<?= $tag['id'] ?>"><?= $tag['tagname'] ?></option>
							<?php endforeach; ?>
						</select>
					</td>
					<td>
						<button type="button" class="btn btn-danger disabled">
							<i class="fa fa-close"></i>
						</button>
					</td>
				</tr>
				<?php foreach($this->having as $key => $value): ?>
					<tr>
						<td>
							<select class="form-control" name="having[<?= $key ?>][name]">'
								<option <?php if($value['name'] == 'height'): ?> selected="selected" <?php endif; ?> value="height">Height</option>
								<option <?php if($value['name'] == 'width'): ?> selected="selected" <?php endif; ?> value="width">Width</option>
								<option <?php if($value['name'] == 'size'): ?> selected="selected" <?php endif; ?> value="size">Filesize</option>
								<option <?php if($value['name'] == 'views'): ?> selected="selected" <?php endif; ?> value="views">Views</option>
							</select>
						</td>
						<td>
							<select class="form-control" name="having[<?= $key ?>][compare]">
								<option <?php if($value['compare'] == 'eq'): ?> selected="selected" <?php endif; ?> value="eq">=</option>
								<option <?php if($value['compare'] == 'neq'): ?> selected="selected" <?php endif; ?> value="neq">!=</option>
								<option <?php if($value['compare'] == 'lt'): ?> selected="selected" <?php endif; ?> value="lt">&lt;</option>
								<option <?php if($value['compare'] == 'lte'): ?> selected="selected" <?php endif; ?> value="lte">&lt;=</option>
								<option <?php if($value['compare'] == 'gt'): ?> selected="selected" <?php endif; ?> value="gt">&gt;</option>
								<option <?php if($value['compare'] == 'gte'): ?> selected="selected" <?php endif; ?> value="gte">&gt;=</option>
							</select>
						</td>
						<td>
							<input placeholder="Value" class="form-control" name="having[<?= $key ?>][value]" type="number" value="<?= $value['value'] ?>">
						</td>
						<td>
							<button type="button" class="btn btn-danger remove_having_filter">
								<i class="fa fa-close"></i>
							</button>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4">
						<button type="submit" class="btn btn-primary">Submit</button>
						<a href="/media" class="btn btn-secondary">Remove Filters</a>
					</td>
				</tr>
			</tfoot>
		</table>
	</form>
</div>

<div class="card clearfix">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item pull-xs-left btn btn-link disabled"><?= count($this->media) ?> Image(s)</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/media/create"><i class="fa fa-plus"></i> Add</a>
			</li>
		</ul>
	</div>
	<div class="card-block">
		<?php foreach( $this->media as $media ): ?>
			<div id="media_<?= $media['id'] ?>" class="card media_card">
				<img class="card-img" src="<?= $media['thumbnail_path'] ?>" alt="Card image">
				<div class="card-img-overlay">

					<div id="media_menu_<?= $media['id'] ?>" class="media_menu">
						<div class="dropdown">
							<button class="btn btn-secondary" type="button" data-toggle="dropdown">
								<i class="fa fa-bars"></i>
							</button>
							<div class="dropdown-menu">
								<a href="/media/update/<?= $media['id'] ?>" class="dropdown-item">
									<i class="fa fa-tags"></i> Edit Tags
								</a>
								<a href="/img/preview/<?= $media['id'] ?>" class="dropdown-item" target="_blank">
									<i class="fa fa-external-link"></i> Preview
								</a>
								<a aria-label="/img/preview/<?= $media['id'] ?>" href="#" class="dropdown-item clipboard">
									<i class="fa fa-clipboard"></i> Copy to Clipboard
								</a>
								<div class="dropdown-divider"></div>
								<a href="/media/delete/<?= $media['id'] ?>" class="dropdown-item">
									<i class="fa fa-close"></i> Delete
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<style>
	.media_card {
		box-sizing: border-box;
		width:204px;
		float:left;
		padding:1px;
		margin:0px;
		margin-right:1rem;
		margin-bottom:1rem;
		text-align: center;
		border:1px solid #ccc;
	}

	.media_menu{
		position: absolute;
		top:0;
		left:0;
		display:none;
	}
</style>

<script type="text/javascript">
	$(function(){
		$("#chosen-select").chosen({width: "100%"});

		new Clipboard('.clipboard', {
			text: function(trigger) {
				alert('Link to the image Copied to clipboard');
				return trigger.getAttribute('aria-label');
			}
		});

		$('.media_card').on('mouseover',function(){
			$(this).find('.media_menu').show();
		});

		$('.media_card').on('mouseout',function(){
			$(this).find('.media_menu').hide();
		});

		if (!Date.now) {
			Date.now = function() { return new Date().getTime(); }
		}

		$('#add_having_filter').on('click',function(ev){

			var ds = new Date().getTime();

			var having_filter = '<tr>'
									+'<td><select class="form-control" name="having['+ds+'][name]">'
											+'<option value="height">Height</option>'
											+'<option value="width">Width</option>'
											+'<option value="size">Filesize</option>'
											+'<option value="views">Views</option>'
										+'</select></td>'
									+'<td><select class="form-control" name="having['+ds+'][compare]">'
											+'<option value="eq">=</option>'
											+'<option value="neq">!=</option>'
											+'<option value="lt">&lt;</option>'
											+'<option value="lte">&lt;=</option>'
											+'<option value="gt">&gt;</option>'
											+'<option value="gte">&gt;=</option>'
										+'</select></td>'
									+'<td><input placeholder="Value" class="form-control" name="having['+ds+'][value]" type="number" value=""></td>'
									+'<td><button type="button" class="btn btn-danger remove_having_filter"><i class="fa fa-close"></i></button>'
								+'</tr>';

			$( having_filter ).appendTo( $( "div#having table tbody" ) );
		});

		$(document).on("click",".remove_having_filter", function( event ){
			$( event.target ).closest("tr").remove();
		});

	});
</script>
