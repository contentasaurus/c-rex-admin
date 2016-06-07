<ol class="breadcrumb">
  <li><a href="/collections">Collections</a></li>
  <li class="active">Update Collection</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<section class="panel panel-default">
			<header class="panel-heading">
				<h3 class="panel-title">Update Collection</h3>
			</header>
			<form method="POST" accept-charset="UTF-8" data-form-ajax="">
				<div class="panel-body">

					<input name="id" type="hidden" value="<?= $this->collection['id'] ?>">

					<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

					<div class="form-group">
						<div class="input-group col-xs-12">
							<div class="col-xs-10">
								<label class="control-label" for="collection_name">Collection Name</label>
								<input placeholder="Name" class="form-control required" id="collection_name" name="collection_name" type="text" value="<?= $this->collection['collection_name'] ?>">
							</div>
							<div class="col-xs-2">
								<label class="control-label" for="collection_index">Index</label>
								<input placeholder="Index" class="form-control required" name="collection_index" id="collection_index" type="text" value="<?= $this->collection['collection_index'] ?>">
							</div>
						</div>
					</div>
					<br />
					<div class="form-group">
						<div class="input-group col-xs-12">
							<div class="col-xs-4">
								<label class="control-label">Keys</label>
							</div>
							<div class="col-xs-7">
								<label class="control-label">Values</label>
							</div>
							<div class="col-xs-1">
								<a id="add_kv" class="btn btn-sm btn-link"><span class="material-icons md-18">add_box</span></a>
							</div>
						</div>
					</div>

					<div id="kv">
						<?php if( !empty($this->collection['collection_data']) ): ?>
							<?php foreach( $this->collection['collection_data'] as $key => $value ): ?>
								<div class="form-group">
									<div class="input-group col-xs-12">
										<div class="col-xs-4">
											<input placeholder="Key" class="form-control" name="collection_data_key[]" type="text" value="<?= $key ?>">
										</div>
										<div class="col-xs-7">
											<input placeholder="Value" class="form-control" name="collection_data_value[]" type="text" value="<?= $value ?>">
										</div>
										<div class="col-xs-1">
											<a class="btn btn-sm btn-link remove_kv"><span class="material-icons md-18 danger">cancel</span></a>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php else: ?>
							<div class="form-group">
								<div class="input-group col-xs-12">
									<div class="col-xs-4">
										<input placeholder="Key" class="form-control" name="collection_data_key[]" type="text" value="">
									</div>
									<div class="col-xs-7">
										<input placeholder="Value" class="form-control" name="collection_data_value[]" type="text" value="">
									</div>
									<div class="col-xs-1">
										<a class="btn btn-sm btn-link remove_kv"><span class="material-icons md-18 danger">cancel</span></a>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group col-xs-12">
									<div class="col-xs-4">
										<input placeholder="Key" class="form-control" name="collection_data_key[]" type="text" value="">
									</div>
									<div class="col-xs-7">
										<input placeholder="Value" class="form-control" name="collection_data_value[]" type="text" value="">
									</div>
									<div class="col-xs-1">
										<a class="btn btn-sm btn-link remove_kv"><span class="material-icons md-18 danger">cancel</span></a>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group col-xs-12">
									<div class="col-xs-4">
										<input placeholder="Key" class="form-control" name="collection_data_key[]" type="text" value="">
									</div>
									<div class="col-xs-7">
										<input placeholder="Value" class="form-control" name="collection_data_value[]" type="text" value="">
									</div>
									<div class="col-xs-1">
										<a class="btn btn-sm btn-link remove_kv"><span class="material-icons md-18 danger">cancel</span></a>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<footer class="panel-footer">
					<div class="pull-right">
						<a class="btn btn-default" href="/collections">Cancel</a>
						<button class="btn btn-primary" type="submit">Update</button>
					</div>
				</footer>

			</form>

		</section>
	</div>
</div>

<script type="text/javascript">
	$('#add_kv').on("click",function(){
		let template = '<div class="form-group">'
			+ '<div class="input-group col-xs-12">'
			+ 	'<div class="col-xs-4"><input placeholder="Key" class="form-control" name="collection_data_key[]" type="text" value=""></div>'
			+ 	'<div class="col-xs-7"><input placeholder="Value" class="form-control" name="collection_data_value[]" type="text" value=""></div>'
			+ 	'<div class="col-xs-1"><a class="btn btn-sm btn-link remove_kv"><span class="material-icons md-18 danger">cancel</span></a></div>'
			+ '</div>'
		+ '</div>';

		$( template ).appendTo( $( "div#kv" ) );
	});

	$(document).on("click",".remove_kv", function( event ){
		$( event.target ).closest("div.form-group").remove();
	});

</script>
