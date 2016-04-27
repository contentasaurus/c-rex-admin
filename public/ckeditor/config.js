/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard', groups: [ 'undo', 'clipboard' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'templates', groups: [ 'templates' ] },
		{ name: 'others', groups: [ 'others' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'paragraph' ] },
		{ name: 'styles', groups: [ 'styles' ] }
	];

	config.extraAllowedContent = 'div(*)';

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Save,Print,Preview,Find,About,Flash,Smiley,NewPage,PageBreak,SpecialChar,Font,FontSize,Table';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;h4';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

	// Set editor height
	config.height = '600px';

	// Bootstrap Skin
	config.skin = 'bootstrapck';

	config.stylesSet = 'pub:/ckeditor/pub/styles.js';

	config.templates_files = ['/ckeditor/pub/templates.js'];
	config.templates_replaceContent = false;

	config.contentsCss = '/css/ckeditor.css';
	config.bodyId = 'content';
	config.extraPlugins = 'templates,oembed,widget,imagebrowser';

	config.imageBrowser_listUrl = "/admin/media/ckeditorBrowse";
	config.filebrowserUploadUrl = '/admin/media/ckeditorUpload';
};
