<script>
	$(function(){
		var editor = ace.edit("editor");
		editor.session.setMode("ace/mode/handlebars");
		editor.getSession().setUseWorker(false);
		editor.setAutoScrollEditorIntoView(true);
		editor.setOption("minLines", 30);
		editor.setOption("maxLines", 40);
		editor.setShowPrintMargin(false);

		$('form').on('submit', function(ev){
			$('input#content').val(editor.getValue());
		});

		editor.commands.addCommand({
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
	#editor {
		position: relative;
	}
</style>
