<ol class="breadcrumb">
  <li><a href="/components">Components</a></li>
  <li class="active">Update Component</li>
</ol>
<div class="container-fluid">
	<div class="col-lg-10">
		<section class="panel panel-default">
			<header class="panel-heading">
				<h3 class="panel-title">Update Component</h3>
			</header>
			<form method="POST" accept-charset="UTF-8" data-form-ajax="">
				<div class="panel-body">

					<input name="id" type="hidden" value="<?= $this->component['id'] ?>">

					<div class="form-group">
						<input placeholder="Name" class="form-control required" name="name" type="text" value="<?= $this->component['name'] ?>">
					</div>
					<div class="form-group">
						<textarea placeholder="Description" class="form-control" name="description"><?= $this->component['description'] ?></textarea>
					</div>

					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#tab_html" aria-controls="home" role="tab" data-toggle="tab">HTML</a></li>
						<li role="presentation"><a href="#tab_css" aria-controls="profile" role="tab" data-toggle="tab">CSS</a></li>
						<li role="presentation"><a href="#tab_js" aria-controls="messages" role="tab" data-toggle="tab">JS</a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="tab_html">
							<div class="form-group">
								<div id="html_editor" class="form-control ace_editor"><?= htmlentities($this->component['html']) ?></div>
								<input type="hidden" name="html" id="html">
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="tab_css">
							<div class="form-group">
								<div id="css_editor" class="form-control ace_editor"><?= htmlentities($this->component['css']) ?></div>
								<input type="hidden" name="css" id="css">
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="tab_js">
							<div class="form-group">
								<div id="js_editor" class="form-control ace_editor"><?= htmlentities($this->component['js']) ?></div>
								<input type="hidden" name="js" id="js">
							</div>
						</div>
					</div>
				</div>

				<footer class="panel-footer">
					<button class="btn btn-primary" type="submit">Save</button>
					<a class="btn btn-default" href="/components">Cancel</a>
				</footer>

			</form>

		</section>
	</div>
</div>

<?php echo $this->partial('components/ace') ?>
