<style type="text/css">
	#page_content {
		position:relative;
		min-height:100%;
		width:100%
	}

	.page_content_full {
		position:absolute;
		top:0;
		left:50;
		min-height:100%;
		width:100%
	}
</style>

<script type="text/javascript">
	$( function(){
		var editor = new MediumEditor('#page_content');

		$('#page_content').mediumInsert({
			editor: editor
		});

		$('#content_fullscreen_toggle').on('click',function(){
			$('section#section_page_content').toggleClass('page_content_full')
		});
	});
</script>
