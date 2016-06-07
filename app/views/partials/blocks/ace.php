<script>
	$(function(){
		var editor = ace.edit("editor");
		editor.session.setMode("ace/mode/handlebars");
		editor.getSession().setUseWorker(false);
		editor.setAutoScrollEditorIntoView(true);
		editor.setOption("minLines", 20);
		editor.setOption("maxLines", 40);
		editor.setShowPrintMargin(false);

		$('form').on('submit', function(ev){
			$('input#content').val(editor.getValue());
		});
	});

</script>

<style type="text/css">
	#editor {
		position: relative;
	}
</style>
