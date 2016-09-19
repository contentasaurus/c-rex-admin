<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Media', 'url' => '/media' ],
	[ 'name'=> 'Update Tags', 'active' => 'true' ],
]]); ?>

<div class="card">
	<div class="card-header">
		Image Details
	</div>
	<table class="table">
		<tbody>
			<tr>
				<td width="210">
					<img class="thumbnail" src="<?= $this->media['thumbnail_path'] ?>" >
				</td>
				<td>
					<table class="table table-bordered table-striped">
						<tbody>
							<tr>
								<th>ID</th>
								<td><?= $this->media['id'] ?></td>
							</tr>
							<tr>
								<th>MIME Type</th>
								<td><?= $this->media['mimetype'] ?></td>
							</tr>
							<tr>
								<th>Remote URI</th>
								<td><?= $this->media['remote_uri'] ?></td>
							</tr>
							<tr>
								<th>Local Path</th>
								<td><?= $this->media['local_path'] ?></td>
							</tr>
							<tr>
								<th>Thumbnail Path</th>
								<td><?= $this->media['thumbnail_path'] ?></td>
							</tr>
							<tr>
								<th>File Size</th>
								<td><?= $this->media['size'] ?></td>
							</tr>
							<tr>
								<th>Height</th>
								<td><?= $this->media['height'] ?></td>
							</tr>
							<tr>
								<th>Width</th>
								<td><?= $this->media['width'] ?></td>
							</tr>
							<tr>
								<th>Views</th>
								<td><?= $this->media['views'] ?></td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<div class="card">
	<div class="card-header">
		Image Tags
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">

			<input name="media_id" type="hidden" value="<?= $this->media['id'] ?>">

			<div class="form-group">
				<label>Tag(s)</label>
				<select multiple class="form-control required chosen-select" name="tags[]">
					<?php foreach( $this->tags as $tag ): ?>
						<option <?php if(in_array( $tag['id'], $this->media_tags )): ?>selected="selected"<?php endif; ?> value="<?= $tag['id'] ?>"><?= $tag['tagname'] ?></option>
					<?php endforeach; ?>
				<select>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Update</button>
				<a class="btn btn-secondary" href="/media">Cancel</a>
			</div>
		</form>
	</div>
</div>

<script>
	$(function(){
		$(".chosen-select").chosen();
	});
</script>
