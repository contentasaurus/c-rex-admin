<script>
	$(function(){

		function set_options( ace_editor ){
			ace_editor.getSession().setUseWorker(false);
			ace_editor.setAutoScrollEditorIntoView(true);
			ace_editor.setOption("minLines", 20);
			ace_editor.setOption("maxLines", 40);
			ace_editor.setShowPrintMargin(false);
		}

		var css_editor = ace.edit("css_editor");
		css_editor.session.setMode("ace/mode/scss");
		set_options(css_editor);

		$('form').on('submit', function(ev){
			$('input#css').val(css_editor.getValue());
		});

		css_editor.commands.addCommand({
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
