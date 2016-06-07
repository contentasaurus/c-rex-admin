<?php use puffin\transformer; ?>

<?php
	$this->media = [
		[
			'id' => 1,
			'uri' => 'http://www.fillmurray.com/200/300',
			'thumbnail_uri' => 'http://www.fillmurray.com/200/300',
			'mimetype' => 'image/jpg',
			'size' => 42000,
			'created_at' => '2016-06-02 12:00:00',
			'updated_at' => '2016-06-02 12:00:00'
		],
		[
			'id' => 2,
			'uri' => 'http://www.fillmurray.com/320/200',
			'thumbnail_uri' => 'http://www.fillmurray.com/320/200',
			'mimetype' => 'image/jpg',
			'size' => 42000,
			'created_at' => '2016-06-02 12:00:00',
			'updated_at' => '2016-06-02 12:00:00'
		],
		[
			'id' => 3,
			'uri' => 'http://www.fillmurray.com/640/400',
			'thumbnail_uri' => 'http://www.fillmurray.com/640/400',
			'mimetype' => 'image/jpg',
			'size' => 42000,
			'created_at' => '2016-06-02 12:00:00',
			'updated_at' => '2016-06-02 12:00:00'
		]
	];
?>

<h1><a href="/media/create" class="btn btn-circle btn-add"><span class="material-icons">add_circle</span> Add Image</a></h1>

<div class="container-fluid">

	<section class="panel panel-default">
		<header class="panel-heading">
			<h3 class="panel-title"><?= count($this->media) ?> Image(s)</h3>
		</header>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Action</th>
					<th>Image</th>
					<th>Tags</th>
					<th>URI</th>
					<th>Mimetype</th>
					<th>Size</th>
					<th>Create Date</th>
					<th>Last Updated</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->media as $media ): ?>
					<tr>
						<td>
							<div>
								<a href="/media/update/<?= $media['id'] ?>" class="btn btn-sm"><span class="material-icons md-18">create</span></a>
								<a href="/media/delete/<?= $media['id'] ?>" class="btn btn-sm"><span class="material-icons md-18 danger">cancel</span></a>
							</div>
						</td>
						<td class="thumb">
							<div style="background-image: url(<?= $media['thumbnail_uri'] ?>);"></div>
						</td>
						<td class="tags">
							<a class="btn btn-primary btn-sm">image-<?= $media['id'] ?></a>
							<a class="btn btn-default btn-sm">my-tag</a>
							<a class="btn btn-default btn-sm">bill-murray</a>
							<a class="btn btn-default btn-sm">my-other-tag</a>
							<a class="btn btn-default btn-sm">my-tag</a>
							<a class="btn btn-default btn-sm">bill-murray</a>
							<a class="btn btn-default btn-sm">my-other-tag</a>
						</td>
						<td width="*">
							<a href="<?= $media['uri'] ?>" target="_blank">
								<?= $media['uri'] ?>
							</a>
						</td>
						<td><?= $media['mimetype'] ?></td>
						<td><?= $media['size'] ?></td>
						<td><?= $media['created_at'] ?></td>
						<td><?= ($media['updated_at'] != '0000-00-00 00:00:00') ? $media['updated_at'] : '--' ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</section>

</div>
<style>
	.thumb {
		min-height:100px;
		width:200px;
	}
	.thumb div{
		position:relative;
		min-height:100px;
		min-width:200px;
		background-size:contain;
		background-repeat:no-repeat;
		background-position:left center
	}
	td.tags {
		max-width: 300px;
	}
	td.tags a.btn {
		margin:2px;
	}
</style>
