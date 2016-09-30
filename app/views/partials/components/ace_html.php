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

		$('form').on('submit', function(ev){
			$('input#html').val(html_editor.getValue());
		});

		html_editor.commands.addCommand({
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
