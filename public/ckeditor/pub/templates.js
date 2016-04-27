/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

// Register a templates definition set named "default".
CKEDITOR.addTemplates( 'default', {
	// The name of sub folder which hold the shortcut preview images of the
	// templates.
	imagesPath: CKEDITOR.getUrl('/ckeditor/pub/template-images/' ),

	// The templates definitions.
	templates: [ {
		title: 'Responsive Table',
		image: 'ResponsiveTable.jpg',
		description: 'Tabular data that will be responsive for mobile.',
		html: '<div class="responsive-table">'+
			'<table cellpadding="0" cellspacing="0">'+
				'<thead>'+
					'<tr>'+
						'<th>Heading Title</th>'+
						'<th>Heading Title</th>'+
					'</tr>'+
				'</thead>'+
				'<tbody>'+
					'<tr>'+
						'<td></td>'+
						'<td></td>'+
					'</tr>'+
				'</tbody>'+
			'</table>'+
		'</div>'
	},
 {
		title: 'Full Width Image',
		image: 'fullWidthImage.jpg',
		description: 'Full screen width image that breaks out of content area',
		html: '<div class="full-width-image full-width">'+
				'<img src="/images/image-placeholder.png" />'+
		'</div>'
	},
 {
		title: 'Gallery Full Image',
		image: 'galleryFullImage.jpg',
		description: 'Full width image for project gallery',
		html: '<div class="gallery-images three-quarters-width">'+
			'<div class="gallery-images-wrapper full three-quarters-width-content">'+
				'<img src="/images/image-placeholder.png" />'+
			'</div>'+
		'</div>'
	},
	{
 		title: 'Gallery Two Images',
 		image: 'galleryTwoImages.jpg',
 		description: 'Two half width images in a row',
 		html: '<div class="gallery-images three-quarters-width">'+
 			'<div class="gallery-images-wrapper two three-quarters-width-content">'+
				'<div class="left-image"><img src="/images/image-placeholder.png" /></div>'+
				'<div class="right-image"><img src="/images/image-placeholder.png" /></div>'+
 			'</div>'+
 		'</div>'
 	},
	{
 		title: 'Gallery Three Images',
 		image: 'galleryThreeImages.jpg',
 		description: 'Three 1/3 width images in a row',
 		html: '<div class="gallery-images three-quarters-width">'+
 			'<div class="gallery-images-wrapper three three-quarters-width-content">'+
				'<div class="left-image"><img src="/images/image-placeholder.png" /></div>'+
				'<div class="middle-image"><img src="/images/image-placeholder.png" /></div>'+
				'<div class="right-image"><img src="/images/image-placeholder.png" /></div>'+
 			'</div>'+
 		'</div>'
 	},
	{
		title: 'Side Stat',
		image: 'sideStat.jpg',
		description: 'This will give you one side stat on the right.',
		html: '<div class="side-stat">'+
			'<span class="number">33</span>'+
			'<p class="description">Description text goes here.</p>'+
		'</div>'
	},
	{
		title: 'Big Numbered List',
		image: 'bigNumberList.jpg',
		description: 'This will give you a numbered list, with big numbers.',
		html: '<div class="big-numbers three-quarters-width">'+
		'<div class="three-quarters-width-content">'+
		'<ol class="big-numbers-ol">'+
			'<li><h6>Item One Title</h6><p>Content words go here.</p></li>'+
			'<li><h6>Item Two Title</h6><p>Content words go here.</p></li>'+
			'<li><h6>Item Three Title</h6><p>Content words go here.</p></li>'+
		'</ol>'+
		'</div>'
	},
	{
		title: 'Stats',
		image: 'stats.jpg',
		description: 'This will give you three stats.',
		html: '<div class="stats-container three-quarters-width">'+
			'<div class="three-quarters-width-content">'+
				'<div class="stat"><span class="above">Number</span><span class="number blue-dark">Number</span><span class="description">Description</span></div>'+
				'<div class="stat"><span class="above">Number</span><span class="number blue-dark">Number</span><span class="description">Description</span></div>'+
				'<div class="stat"><span class="above">Number</span><span class="number blue-dark">Number</span><span class="description">Description</span></div>'+
			'</div>'+
		'</div>'
	},
	{
		title: '50/50 Img/Text',
		image: 'img-text.jpg',
		description: 'This will give you half image on the left and half text on the right.',
		html: '<div class="img-text full-width">'+
				'<div class="img"><img src="/images/image-placeholder.png" /></div>'+
				'<div class="text">text here</div>'+
		'</div>'
	},
	{
		title: '50/50 Text/Img',
		image: 'text-img.jpg',
		description: 'This will give you half text on the left and half image on the right.',
		html: '<div class="text-img full-width">'+
				'<div class="text">text here</div>'+
				'<div class="img"><img src="/images/image-placeholder.png" /></div>'+
		'</div>'
	},
	{
		title: '50/50 Text/Img Article Feature',
		image: 'text-img.jpg',
		description: 'This will give you half text on the left and half image on the right.',
		html: '<div class="text-img article">'+
		'<div class="wrapper">'+
				'<div class="text"><p>Text here, put the words in this space. And so it was that <strong>words went here</strong>. It was good. The words here.</p></div>'+
				'<div class="img"><img src="/images/image-placeholder.png" /></div>'+
		'</div>'+
		'<p class="caption">Caption Here</p>'+
		'</div>'
	},
	{
		title: 'Pattern Quote',
		image: 'pattern-quote.jpg',
		description: 'This will give you a full width container with centered text.',
		html: '<div class="pattern-quote full-width">'+
				'<div class="text">text here</div>'+
		'</div>'
	} ]
} );
