<?php

use LightnCandy\LightnCandy as LightnCandy;

class handlebars
{
	public $helpers = [];
	private $partials = [];
	private $layout = [];

	public function __construct(){}

	public function compile( $template )
	{
		return LightnCandy::compile( $template, [
			'flags' =>LightnCandy::FLAG_HANDLEBARS
					| LightnCandy::FLAG_STANDALONEPHP
					| LightnCandy::FLAG_ERROR_LOG
					| LightnCandy::FLAG_RENDER_DEBUG
					| LightnCandy::FLAG_ERROR_EXCEPTION
					| LightnCandy::FLAG_RUNTIMEPARTIAL
					| LightnCandy::FLAG_NAMEDARG
					| LightnCandy::FLAG_ELSE
					| LightnCandy::FLAG_ADVARNAME,
			'partials' => $this->get_partials(),
			'prepartial' => function ($context, $template, $name) {
				$nl = chr(10).chr(13);
				return "$nl<!-- partial start: $name -->$nl$template $nl<!-- partial end: $name -->$nl";
			},
			'partialresolver' => function ($cx, $name) {
				return "<div style='padding:1em; border:1px dashed yellow; background:red; color:yellow;'>Component \"$name\" not found</div>";
			},
			'helpers' => [
				'concat' => function(){
					$args = func_get_args();
					$context = array_pop($args);
					return implode('', $args);
				},
				'debug' => function( $x, $context ){
					return json_encode($x);
				},
				'eq' => function( $a, $b ){
					return $a == $b;
				},
				'neq' => function( $a, $b ){
					return $a != $b;
				},
				'gt' => function( $a, $b ){
					return $a > $b;
				},
				'lt' => function( $a, $b ){
					return $a < $b;
				},
				'gte' => function( $a, $b ){
					return $a >= $b;
				},
				'lte' => function( $a, $b ){
					return $a <= $b;
				},
				'times' => function( $times, $options ){
					$return = '';
					for( $i = 0; $i < $times; $i++ )
					{
						$return .= $options['fn']();
					}
					return $return;
				}
			]
		]);
	}

	public function render( $php, $data = [] )
	{
		error_reporting(-1);
		ini_set('display_errors', 1);

		$renderer = LightnCandy::prepare( $php );

		$return = $renderer( $data, [
			'debug' => \LightnCandy\Runtime::DEBUG_ERROR_LOG
		]);

		return $return;

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
