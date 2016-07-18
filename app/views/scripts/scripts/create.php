<ol class="breadcrumb">
  <li><a href="/scripts">Scripts</a></li>
  <li class="active">Create Script</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<section class="panel panel-default">
			<header class="panel-heading">
				<h3 class="panel-title">Create Script</h3>
			</header>
			<form method="POST" accept-charset="UTF-8" data-form-ajax="">
				<div class="panel-body">

					<input name="author_user_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">

					<div class="form-group">
						<label>Name</label>
						<input placeholder="Name" class="form-control required" name="name" type="text">
					</div>
					<div class="form-group">
						<label>Type</label>
						<select name="script_type_id" id="script_type_id" class="form-control required" >
							<option value="">Choose a type</option>
							<?php foreach( $this->script_types as $type ): ?>
								<option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label>Content</label>
						<div id="editor" class="form-control"><?= htmlentities('<code>') ?></div>
						<input type="hidden" name="html" id="content">
					</div>

				</div>

				<footer class="panel-footer">
					<button class="btn btn-primary" type="submit">Create</button>
					<a class="btn btn-default" href="/scripts">Cancel</a>
				</footer>

			</form>

		</section>
	</div>
</div>

<?php echo $this->partial('scripts/ace',[ 'script_types' => $this->script_types ]); ?>
