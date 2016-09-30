<script>
	$(function(){

		function set_options( ace_editor ){
			ace_editor.getSession().setUseWorker(false);
			ace_editor.setAutoScrollEditorIntoView(true);
			ace_editor.setOption("minLines", 20);
			ace_editor.setOption("maxLines", 40);
			ace_editor.setShowPrintMargin(false);
		}

		var js_editor = ace.edit("js_editor");
		js_editor.session.setMode("ace/mode/javascript");
		set_options(js_editor);

		$('form').on('submit', function(ev){
			$('input#js').val(js_editor.getValue());
		});

		js_editor.commands.addCommand({
			name: 'save',
			bindKey: {win: 'Ctrl-S',  mac: 'Command-S'},
			exec: function(editor) {
				$('input#content').val(editor.getValue());
				$('form').submit();
			},
			readOnly: false // false if this command should not apply in readOnly mode
		});
	});

</script>

<style type="text/css">
	.ace_editor {
		position: relative;
	}
</style>
