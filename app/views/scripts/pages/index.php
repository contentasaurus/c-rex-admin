<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Pages', 'active' => 'true'  ],
]]); ?>

<div class="card">
	<div class="card-header">
		<ul class="nav card-header-pills">
			<li class="nav-item">
				<a class="nav-item pull-xs-left btn btn-link disabled"><?= count($this->pages) ?> Page(s)</a>
				<a class="nav-item pull-xs-right btn btn-secondary" href="/pages/create"><i class="fa fa-plus"></i> Add Page</a>
			</li>
		</ul>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover tt-table">
			<thead>
				<tr>
					<th width="50"><br /></th>
					<th>Structure</th>
					<th>Name</th>
					<th>Versions</th>
					<th>Split</th>
					<th width="100"><br /></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach( $this->pages as $page ): ?>
					<tr>
						<td>
							<a href="/pages/update/<?= $page['id'] ?>" class="btn btn-sm btn-secondary">
								<i class="fa fa-pencil"></i>
							</a>
						</td>
						<td>
							<?php if( !empty($this->treetable[$page['id']]) ): ?>
								<div class="tt <?php if( !$page['is_publishable'] ): ?>tt-disabled<?php endif; ?>" data-tt-id="node_<?= $this->treetable[$page['id']]['node_id'] ?>" data-tt-parent="node_<?= $this->treetable[$page['id']]['parent_node_id'] ?>">
							<?php else: ?>
								<div class="tt <?php if( !$page['is_publishable'] ): ?>tt-disabled<?php endif; ?>" data-tt-id="node_1" data-tt-parent="">
							<?php endif; ?>

								<?php if( @strlen($this->treetable[$page['id']]['parent']) > 1 ): ?>
									<?= str_replace($this->treetable[$page['id']]['parent'], '', $page['permalink']) ?>
								<?php elseif( $page['permalink'] == '/' ): ?>
									<i class="fa fa-home"></i>
								<?php else: ?>
									<?= $page['permalink'] ?>
								<?php endif; ?>
								<button type="button" class="tt-button btn btn-sm btn-link" data-toggle="popover" title="Add Page" data-html="true" data-content='
									<form class="form-inline" method="post" action="/pages/create">
										<input type="hidden" name="quick_add" value="true">
										<input type="hidden" name="author_user_id" value="<?= $_SESSION['user']['id'] ?>">
										<input type="hidden" name="name" value="New Page">
										<input type="text" class="form-control" name="permalink" value="<?= $page['permalink'] ?>" />
										<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></button>
									</form>
								'>
									<i class="fa fa-plus"></i>
								</button>
							</div>

						</td>
						<td><?= $page['name'] ?></td>
						<td><?= $page['num_versions'] ?></td>
						<td><?= $page['split'] ?></td>
						<td>
							<?php if( $page['is_publishable'] ): ?>
								<a href="/pages/publish/<?= $page['id'] ?>/state/0" class="btn btn-sm btn-success">On</a>
							<?php else: ?>
								<a href="/pages/publish/<?= $page['id'] ?>/state/1" class="btn btn-sm btn-secondary">Off</a>
							<?php endif; ?>
							<?= $this->partial('delete', [
								'url' => '/pages/delete/' . $page['id'],
								'id' => $page['id'],
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
		$("table.tt-table").treetable();

		$('[data-toggle="popover"]').popover();
	});
</script>

<style>
	.tt-table div.tt {
		display:inline-block;
		position:relative;
	}

	.tt-table div.tt div.content,
	.tt-table div.tt-parent div.content {
		border:1px gray solid;
		border-radius: 4px;
		z-index: 1;
		padding:4px 6px;
		/*padding:0 4px 0 5px;*/
		position:relative;
		background-color: #dbffbe;
	}

	.tt-button {
		position:relative;
		left:inherit;
		color:inherit;
	}

	.tt-table div.tt div.tail {
		border:2px gray solid;
		border-right: 0;
		border-top: 0;
		position:absolute;
		border-radius: 2px;
		bottom: 11px;
		left: -10px;
		z-index: 0;
	}

	.tt-table div.tt-disabled div.content {
		background-color: lightgray;
	}

	.tt-table tr.tt-hide {
		display:none;
	}
</style>
