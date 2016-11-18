<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Blog', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item float-xs-left btn btn-link disabled"><?= count($this->blogs) ?> Blog Post(s)</a>
				<a class="nav-item float-xs-right btn btn-secondary" href="/blog/create"><i class="fa fa-plus"></i> Add</a>
			</li>
		</ul>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th width="50"><br /></th>
					<th>Title</th>
					<th>Author</th>
					<th>Summary</th>
					<th>Publication Date</th>
					<th width="100"><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->blogs as $blog ): ?>
					<tr>
						<td>
							<a href="/blog/update/<?= $blog['id'] ?>" class="btn btn-sm btn-secondary">
								<i class="fa fa-pencil"></i>
							</a>
						</td>
						<td>
							<div><?= $blog['title'] ?></div>
							<div><small class="text-muted"><?= $blog['slug'] ?></small></div>
						</td>
						<td><?= $blog['author'] ?></td>
						<td><?= $blog['summary'] ?></td>
						<td><?= ($blog['publication_date'] != '0000-00-00 00:00:00') ? date('m/d/Y', strtotime($blog['publication_date'])) : '--' ?></td>
						<td>
							<?php if( $blog['is_publishable'] ): ?>
								<a href="/blog/publish/<?= $blog['id'] ?>/state/0" class="btn btn-sm btn-success">On</a>
							<?php else: ?>
								<a href="/blog/publish/<?= $blog['id'] ?>/state/1" class="btn btn-sm btn-secondary">Off</a>
							<?php endif; ?>

							<?= $this->partial('delete', [
								'url' => '/blog/delete/' . $blog['id'],
								'id' => $blog['id'],
							]); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(function(){
		$('[data-toggle="popover"]').popover();
	});
</script>
