<?php use puffin\transformer; ?>

<?= $this->partial('breadcrumb', [ 'crumbs' => [
	[ 'name'=> 'Blog', 'url' => '/blog'  ],
	[ 'name'=> 'Update', 'active' => 'true'  ],
]]); ?>


<div class="card">
	<div class="card-header">
		Update Blog Post
	</div>
	<div class="card-block">
		<form method="POST" accept-charset="UTF-8" data-form-ajax="">
			<input name="id" type="hidden" value="<?= $this->blog['id'] ?>">

			<div class="form-group">
				<label>Title</label>
				<input placeholder="Title" max="200" class="form-control required" name="title" type="text" value="<?= $this->blog['title'] ?>">
			</div>
			<div class="form-group">
				<label>Slug</label>
				<input placeholder="Slug" max="250" class="form-control required" name="slug" type="text" value="<?= $this->blog['slug'] ?>">
			</div>
			<div class="form-group">
				<label>Author</label>
				<input placeholder="Author" max="100" class="form-control required" name="author" type="text" value="<?= $this->blog['author'] ?>">
			</div>
			<div class="form-group">
				<label>Publication Date</label>
				<input class="form-control required" name="publication_date" type="date" value="<?= date( 'Y-m-d', strtotime($this->blog['publication_date']) ) ?>">
			</div>
			<div class="form-group">
				<label>Summary</label>
				<textarea placeholder="Summary" max="500" class="form-control" rows="3" name="summary"><?= $this->blog['summary'] ?></textarea>
			</div>
			<div class="form-group">
				<label>Contents</label>
				<textarea placeholder="Contents" class="form-control wysiwyg" rows="10" name="contents"><?= $this->blog['contents'] ?></textarea>
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Save</button>
				<a class="btn btn-secondary" href="/blog">Cancel</a>
			</div>

		</form>
	</div>
</div>

<script>
	$(function(){
		$('.wysiwyg').summernote({
			height: 300,
			toolbar: [
				['style', ['bold', 'italic', 'underline', 'clear']],
				['font', ['strikethrough']],
				['para', ['ul', 'ol', 'paragraph']]
			]
		});

		 $('.note-popover').css({'display': 'none'});
	});
</script>
