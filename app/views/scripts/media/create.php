<ol class="breadcrumb">
  <li><a href="/media">Media</a></li>
  <li class="active">Add Image(s)</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<form method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
			<section class="panel panel-default">
				<header class="panel-heading">
					<h3 class="panel-title">Upload Image(s)</h3>
				</header>
				<div class="panel-body">
					<div class="form-group">
						<div class="input-group col-xs-12">
							<label>Select File(s)</label>
							<input multiple class="form-control required" name="files[]" id="files" type="file" />
						</div>
					</div>
				</div>
			</section>

			<section class="panel panel-default">
				<header class="panel-heading">
					<h3 class="panel-title">Link to Image(s)</h3>
				</header>
				<div class="panel-body">

					<div class="form-group">
						<div class="input-group col-xs-12">
							<label class="pull-left">URLs</label>
							<button id="add_uri" type="button" class="btn btn-success pull-right"><i class="fa fa-plus" aria-hidden="true"></i></button>
						</div>
					</div>
					<div id="uris">
						<?php for( $i=0; $i<3;$i++ ): ?>
							<div class="form-group">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="http://example.com/my-file.png" name="links[]">
									<span class="input-group-btn">
										<button class="btn btn-danger remove_uri" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
									</span>
								</div>
							</div>
						<?php endfor; ?>
					</div>
				</div>
			</section>

			<section class="panel panel-default">
				<header class="panel-heading">
					<h3 class="panel-title">Apply Tags</h3>
				</header>
				<div class="panel-body">
					<div class="form-group">
						<div class="input-group col-xs-12">
							<label>Tag(s)</label>
							<select multiple class="form-control required chosen-select" name="tags[]">
								<?php foreach( $this->tags as $tag ): ?>
									<option value="<?= $tag['id'] ?>"><?= $tag['tagname'] ?></option>
								<?php endforeach; ?>
							<select>
						</div>
					</div>
				</div>
			</section>

			<section class="panel panel-default">
				<footer class="panel-footer">
					<div class="pull-right">
						<a class="btn btn-default" href="/media">Cancel</a>
						<button class="btn btn-primary" type="submit">Save</button>
					</div>
				</footer>
			</section>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$('#add_uri').on("click",function(){
			let template = '<div class="form-group">'
				+ '<div class="input-group">'
				+	'<input type="text" class="form-control" placeholder="http://example.com/my-file.png" name="links[]">'
				+	'<span class="input-group-btn"><button class="btn btn-danger remove_uri" type="button"><i class="fa fa-times" aria-hidden="true"></i></button></span>'
				+ '</div>'
			+ '</div>';

			$( template ).appendTo( $( "div#uris" ) );
		});

		$(document).on("click",".remove_uri", function( event ){
			$( event.target ).closest("div.form-group").remove();
		});

		$(".chosen-select").chosen();
	})
</script>
