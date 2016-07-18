<script>
	$(function(){

		function set_options( ace_editor ){
			ace_editor.getSession().setUseWorker(false);
			ace_editor.setAutoScrollEditorIntoView(true);
			ace_editor.setOption("minLines", 20);
			ace_editor.setOption("maxLines", 40);
			ace_editor.setShowPrintMargin(false);
		}

		var html_editor = ace.edit("html_editor");
		html_editor.session.setMode("ace/mode/handlebars");
		set_options(html_editor);

		var css_editor = ace.edit("css_editor");
		css_editor.session.setMode("ace/mode/css");
		set_options(css_editor);

		var js_editor = ace.edit("js_editor");
		js_editor.session.setMode("ace/mode/javascript");
		set_options(js_editor);

		$('form').on('submit', function(ev){
			$('input#html').val(html_editor.getValue());
			$('input#css').val(css_editor.getValue());
			$('input#js').val(js_editor.getValue());
		});
	});

</script>

<style type="text/css">
	.ace_editor {
		position: relative;
	}
</style>
