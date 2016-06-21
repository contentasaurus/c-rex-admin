<?php use puffin\transformer; ?>

<h1><a href="/media/create" class="btn btn-circle btn-add"><span class="material-icons">add_circle</span> Add Image</a></h1>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand"><?= count($this->media) ?> Image(s)</a>
		</div>
		<button id="filter_vis_toggle" type="button" class="pull-right btn btn-default navbar-btn"><span class="material-icons md-18">filter_list</span></button>
	</div>
</nav>

<div class="container-fluid">

	<section id="filter_form" class="panel panel-default" <?php if(empty($this->having) && empty($this->selected_tags)): ?>style="display:none;" <?php endif; ?>>
		<div class="panel-heading">
			<h3 class="panel-title">Filter Images</h3>
		</div>
		<div class="panel-body">
			<form method="get">
				<div class="form-group col-lg-12 col-md-12 col-xs-12">
					<label>Tag(s)</label>
					<select id="chosen-select" multiple class="form-control required" name="tags[]">
						<?php foreach( $this->tags as $tag ): ?>
							<option <?php if( in_array($tag['id'], $this->selected_tags) ): ?>selected="selected"<?php endif; ?> value="<?= $tag['id'] ?>"><?= $tag['tagname'] ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="form-group">
					<a id="add_having_filter" class="btn btn-default">Add Filter</a>
				</div>
				<div id="having" class="form-group">
					<?php foreach($this->having as $key => $value): ?>
						<div class="form-group col-xs-12">
							<div class="col-lg-3 col-sm-3 col-md-3">
								<select class="form-control" name="having[<?= $key ?>][name]">'
									<option <?php if($value['name'] == 'height'): ?> selected="selected" <?php endif; ?> value="height">Height</option>
									<option <?php if($value['name'] == 'width'): ?> selected="selected" <?php endif; ?> value="width">Width</option>
									<option <?php if($value['name'] == 'size'): ?> selected="selected" <?php endif; ?> value="size">Filesize</option>
									<option <?php if($value['name'] == 'views'): ?> selected="selected" <?php endif; ?> value="views">Views</option>
								</select>
							</div>
							<div class="col-lg-3 col-sm-3 col-md-3">
								<select class="form-control" name="having[<?= $key ?>][compare]">
									<option <?php if($value['compare'] == 'eq'): ?> selected="selected" <?php endif; ?> value="eq">=</option>
									<option <?php if($value['compare'] == 'neq'): ?> selected="selected" <?php endif; ?> value="neq">!=</option>
									<option <?php if($value['compare'] == 'lt'): ?> selected="selected" <?php endif; ?> value="lt">&lt;</option>
									<option <?php if($value['compare'] == 'lte'): ?> selected="selected" <?php endif; ?> value="lte">&lt;=</option>
									<option <?php if($value['compare'] == 'gt'): ?> selected="selected" <?php endif; ?> value="gt">&gt;</option>
									<option <?php if($value['compare'] == 'gte'): ?> selected="selected" <?php endif; ?> value="gte">&gt;=</option>
								</select>
							</div>
							<div class="col-lg-3 col-sm-3 col-md-3">
								<input placeholder="Value" class="form-control" name="having[<?= $key ?>][value]" type="number" value="<?= $value['value'] ?>">
							</div>
							<div class="col-lg-1 col-sm-1 col-md-1">
								<a class="btn btn-sm btn-link remove_having_filter"><span class="material-icons md-18 danger">cancel</span></a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Submit</button>
					<a href="/media" class="btn btn-default">Remove Filters</a>
				</div>

			</form>
		</div>
	</section>

	<?php foreach( $this->media as $media ): ?>

	<div class="media_img">
		<div class="thumbnail">
			<img src="<?= $media['thumbnail_path'] ?>">
			<div class="caption">
				<p align="center">
					<strong><?= $media['width'] ?>x<?= $media['height'] ?>, <span title="<?= $media['size'] ?> Bytes"><?= transformer::filesize($media['size']) ?></span></strong>
					<div>
						<a href="/media/update/<?= $media['id'] ?>" class="btn btn-sm"><span class="material-icons md-18">local_offer</span></a>
						<a href="/img/preview/<?= $media['id'] ?>" target="_blank" class="btn btn-sm"><span class="material-icons md-18">open_in_new</span></a>
						<a aria-label="/img/preview/<?= $media['id'] ?>" class="btn clipboard btn-sm"><span class="material-icons md-18">content_paste</span></a>
						<a href="/media/delete/<?= $media['id'] ?>" class="btn btn-sm"><span class="material-icons md-18 danger">cancel</span></a>
					</div>
				</p>
			</div>
		</div>
	</div>

	<?php endforeach; ?>

</div>
<style>
	.media_img {
		float:left;
		margin:5px;
		padding: 5px
	}

	.thumbnail {
		height:300px;
	}

	.thumbnail img{
		border:1px solid silver;
	}

	p.tags {
		max-width: 300px;
	}
	p.tags a.btn {
		margin:2px;
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

		$('#filter_vis_toggle').on('click',function(ev){
			$('#filter_form').toggle();
		});

		$(function(){

			if (!Date.now) {
				Date.now = function() { return new Date().getTime(); }
			}

			$('#add_having_filter').on('click',function(ev){

				let ds = new Date().getTime();

				let having_filter = '<div class="form-group col-xs-12">'
										+'<div class="col-lg-1 col-sm-1 col-md-1">'
											+'<select class="form-control" name="having['+ds+'][name]">'
												+'<option value="height">Height</option>'
												+'<option value="width">Width</option>'
												+'<option value="size">Filesize</option>'
												+'<option value="views">Views</option>'
											+'</select>'
										+'</div>'
										+'<div class="col-lg-1 col-sm-1 col-md-1">'
											+'<select class="form-control" name="having['+ds+'][compare]">'
												+'<option value="eq">=</option>'
												+'<option value="neq">!=</option>'
												+'<option value="lt">&lt;</option>'
												+'<option value="lte">&lt;=</option>'
												+'<option value="gt">&gt;</option>'
												+'<option value="gte">&gt;=</option>'
											+'</select>'
										+'</div>'
										+'<div class="col-lg-1 col-sm-1 col-md-1">'
											+'<input placeholder="Value" class="form-control" name="having['+ds+'][value]" type="number" value="">'
										+'</div>'
										+'<div class="col-lg-1 col-sm-1 col-md-1">'
											+'<a class="btn btn-sm btn-link remove_having_filter"><span class="material-icons md-18 danger">cancel</span></a>'
										+'</div>'
									+'</div>';

				$( having_filter ).appendTo( $( "div#having" ) );
			});

			$(document).on("click",".remove_having_filter", function( event ){
				$( event.target ).closest("div.form-group").remove();
			});
		});

	});
</script>
