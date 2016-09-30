<?php
use \puffin\url as url;
use \puffin\view as view;
use \puffin\file as file;
use \puffin\directory as directory;
use \puffin\transformer as transformer;
use \Leafo\ScssPhp\Compiler as scss_compiler;

class preview_controller extends puffin\controller\action
{
	public $components = [];

	public function __construct(){}

	public function __init()
	{
		$this->page_preview = new page_preview();
		$this->hbs = new handlebars();
	}

	#----------------------------------------------------------------

	public function preview( $version_id = false )
	{
		view::layout('preview');

		$this->components['html'] = $this->page_preview->get_components_html();
		$this->components['css'] = $this->page_preview->get_components_css();
		$this->components['js'] = $this->page_preview->get_components_js();
		$this->components['nonblocking_js'] = $this->page_preview->get_components_nbjs();

		$this->hbs->set_partials( $this->components['html'] );

		$this->components['css'] = '<style>'.$this->make_components_css( $this->components['css'] ).'</style>';

		$page = $this->page_preview->get_versions($version_id);
		$page = reset($page);
		$page['compiled'] = $this->compile_lightncandy( $page );
		$page['preview'] = $this->render_lightncandy( $page['compiled'], $page['page_id']);

		view::add_param( 'html', $page['preview'] );
	}

	#----------------------------------------------------------------

	private function compile_lightncandy( $page )
	{
		$layout = $this->page_preview->get_layout( $page['layout'] );

		$this->hbs->set_layout( $layout['content'] );

		$template = '{{#>__cms_layout}}'
					.	'{{#*inline "meta"}}' . $layout['meta'] . '{{/inline}}'
					.	'{{#*inline "title"}}'.$page['title'].'{{/inline}}'
					.	'{{#*inline "js"}}' . $layout['js'] . $this->components['js'] .'{{/inline}}'
					.	'{{#*inline "css"}}' . $layout['style'] . $this->components['css'] . '{{/inline}}'
					.	'{{#*inline "contents"}}' . $page['contents'] . '{{/inline}}'
					.	'{{#*inline "nonblocking_js"}}' . $layout['nonblocking_js'] . $this->components['nonblocking_js'] .'{{/inline}}'
					.'{{/__cms_layout}}';

		return $this->hbs->compile( $template );
	}

	private function render_lightncandy( $compiled_template, $page_id )
	{
		return $this->hbs->render( $compiled_template, $this->page_preview->get_page_data($page_id) );
	}

	public function make_components_css( $sass )
	{
		// $path = PUBLIC_PATH . '/css/';
		//
		// if( !directory::exists( $path ) )
		// {
		// 	directory::create( $path );
		// }

		$scss = new scss_compiler();
		$css = $scss->compile( $sass );

		$autoprefixer = new Autoprefixer([
			'last 2 versions',
			'iOS 8'
		]);

		$prefixed_css = $autoprefixer->compile($css);

		#if this is an export, add the css to the exported db table
		#$this->page_preview->add_css($prefixed_css);

		#if this is preview, put the css in a temp file.
		#file::write( "$path/components.css", $prefixed_css );

		return $prefixed_css;
	}

}
