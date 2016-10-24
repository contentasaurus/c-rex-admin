<?php

use LightnCandy\LightnCandy as LightnCandy;

class handlebars
{
	private $partials = [];
	private $layout = [];
	// [
	// 	'header' => '<html>{{ data }}</html>',
	// 	'hunter2' => '<section>{{ data }}</section>'
	// ]

	public function __construct(){}

	public function compile( $template )
	{
		// foreach( $this->get_partials() as $partial )
		// {
		// 	debug( htmlentities( $partial ) );
		// }
		// debug($template); exit;
		return LightnCandy::compile( $template, [
			'flags' =>LightnCandy::FLAG_HANDLEBARS
					| LightnCandy::FLAG_RENDER_DEBUG
					| LightnCandy::FLAG_RUNTIMEPARTIAL
					| LightnCandy::FLAG_NAMEDARG
					| LightnCandy::FLAG_ELSE
					| LightnCandy::FLAG_ADVARNAME,
			'partials' => $this->get_partials(),
			'partialresolver' => function ($cx, $name) {
				return "<div style=\"padding:1em; border:1px dashed yellow; background:red; color:yellow;\">Component \"$name\" not found</div>";
			}
		]);
	}

	public function render( $php, $data = [] )
	{
		$renderer = LightnCandy::prepare($php);
		return $renderer( $data );
	}

	public function set_partial( $partial )
	{
		$this->partials []= $partials;
	}

	public function set_partials( $partials )
	{
		$this->partials = array_merge( $this->partials, $partials );
	}

	public function get_partials()
	{
		return $this->partials;
	}

	public function set_layout( $layout )
	{
		$this->partials['__cms_layout'] = $layout;
	}
}
