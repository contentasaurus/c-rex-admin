<?php

use \puffin\view as view;

class bower extends  puffin\controller\plugin
{
	public function __init()
	{
		$BOWERDIR = '/bower_components';

		#d3
		// view::add_js("$BOWERDIR/d3/d3.min.js", $nonblocking = false);

		#jQuery
		// view::add_js("$BOWERDIR/jquery/dist/jquery.min.js", $nonblocking = false);
		// view::add_js("$BOWERDIR/jquery-ui/jquery-ui.min.js", $nonblocking = false);
		// view::add_js("$BOWERDIR/jquery-sortable/source/js/jquery-sortable-min.js", $nonblocking = true);
		// view::add_js("$BOWERDIR/jquery-treetable/jquery.treetable.js", $nonblocking = false);
		view::add_css("$BOWERDIR/jquery-treetable/css/jquery.treetable.css");
		//view::add_css("$BOWERDIR/jquery-treetable/css/jquery.treetable.theme.default.css");

		#clipboard
		// view::add_js("$BOWERDIR/clipboard/dist/clipboard.min.js", $nonblocking = true);

		#chosen
		// view::add_js("$BOWERDIR/chosen/chosen.jquery.js", $nonblocking = false);
		view::add_css("$BOWERDIR/chosen/chosen.css");

		#handlebars
		// view::add_js("$BOWERDIR/handlebars/handlebars.min.js", $nonblocking = false);

		#tether
		view::add_css("$BOWERDIR/tether/dist/css/tether.min.css");
		// view::add_js("$BOWERDIR/tether/dist/js/tether.min.js", $nonblocking = true);

		#bootstrap
		view::add_css("$BOWERDIR/bootstrap/dist/css/bootstrap.min.css");
		// view::add_js("$BOWERDIR/bootstrap/dist/js/bootstrap.min.js", $nonblocking = true);

		#medium editor
		// view::add_css("$BOWERDIR/medium-editor/dist/css/medium-editor.min.css");
		// view::add_css("$BOWERDIR/medium-editor/dist/css/themes/default.min.css");
		// view::add_js("$BOWERDIR/medium-editor/dist/js/medium-editor.min.js", $nonblocking = true);
		// view::add_css("$BOWERDIR/medium-editor-insert-plugin/dist/css/medium-editor-insert-plugin.min.css");
		// view::add_css("$BOWERDIR/medium-editor-insert-plugin/dist/css/medium-editor-insert-plugin-frontend.min.css");
		// view::add_js("$BOWERDIR/medium-editor-insert-plugin/dist/js/medium-editor-insert-plugin.min.js", $nonblocking = true);

		#ace
		// view::add_js("$BOWERDIR/ace-builds/src-min-noconflict/ace.js", $nonblocking = true);

		#blueimp
		// view::add_js("$BOWERDIR/blueimp-tmpl/js/tmpl.min.js", $nonblocking = true);
		// view::add_js("$BOWERDIR/blueimp-load-image/js/load-image.all.min.js", $nonblocking = true);
		// view::add_js("$BOWERDIR/blueimp-canvas-to-blob/js/canvas-to-blob.min.js", $nonblocking = true);
		// view::add_js("$BOWERDIR/blueimp-file-upload/js/jquery.fileupload.js", $nonblocking = true);

	}
	public function __before_call()
	{
		return false;
	}
	public function __after_call()
	{
		return false;
	}
}
