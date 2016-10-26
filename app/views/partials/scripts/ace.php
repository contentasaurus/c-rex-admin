<script>
	$(function(){
		var editor = ace.edit("editor");
		editor.getSession().setUseWorker(false);
		editor.setAutoScrollEditorIntoView(true);
		editor.setOption("minLines", 20);
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

		$('#script_type_id').on('change', function(ev){
			var type = $('#script_type_id').val();

			if( type == 2 ) {
				editor.session.setMode("ace/mode/javascript");
			} else if( type == 3 ) {
				editor.session.setMode("ace/mode/javascript");
			} else if( type == 4 ) {
				editor.session.setMode("ace/mode/scss");
			} else {
				editor.session.setMode("ace/mode/handlebars");
			}

		});
	});

</script>

<style type="text/css">
	#editor {
		position: relative;
	}
</style>
