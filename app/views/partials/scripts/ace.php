<script>
	$(function(){
		var editor = ace.edit("editor");
		editor.session.setMode("ace/mode/handlebars");
		editor.getSession().setUseWorker(false);
		editor.setAutoScrollEditorIntoView(true);
		editor.setOption("minLines", 20);
		editor.setOption("maxLines", 40);
		editor.setShowPrintMargin(false);

		<?php if(isset($this->html)):?>
		editor.setValue(decodeURIComponent('<?= urlencode($this->html) ?>').replace(/\+/g, ' '));
		<?php endif; ?>

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
			switch( $('#script_type_id').val() ) {
				<?php foreach( $this->script_types as $type ): ?>
				case '<?= $type['id'] ?>':
					editor.setValue(decodeURIComponent('<?= urlencode($type['template']) ?>').replace(/\+/g, ' '));
					break;
				<?php endforeach; ?>
				default:
					editor.setValue('<code>');
			}

		});
	});

</script>

<style type="text/css">
	#editor {
		position: relative;
	}
</style>
