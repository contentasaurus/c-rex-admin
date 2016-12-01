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
				},
				'if_empty' => function( $a, $b ){
					if( empty($a) ){
						return $b;
					}
					return $a;
				},
				'pick' => function( $options ) {
					$from = $options['hash']['from'];
					$select = $options['hash']['select'];
					$where = $options['hash']['where'];
					$equals = $options['hash']['equals'];

					foreach ($from as $element) {
						if($equals == $element[$where]) {
							return $element[$select];
						}
					}
				},
				'blog' => function( $options ) {
					if(empty($options)) return '';
					
					if(empty($options['fn'])) return '';
					else {
						$fn = $options['fn'];
					}
					
					if(empty($options['hash'])) return '';
					else {
						$vars = $options['hash'];
					}

					$id = '';
					if(!empty($vars['id'])) {
						$id = "WHERE id = ${vars['id']}";
					}

					$date_format = 'F jS, Y';
					if(!empty($vars['date_format'])) {
						$date_format = $vars['date_format'];
					}

					$hide_after = 0; // 0 is no-hide
					if(!empty($vars['hide_after'])) {
						$hide_after = $vars['hide_after'];
					}

					$_this = [];
					if(!empty($vars['_this'])) {
						$_this = $vars['_this'];
					}

					$num = '10';
					if(!empty($vars['num'])) {
						$num = $vars['num'];
					}

					$order = 'DESC';
					if(!empty($vars['order'])) {
						$order = $vars['order'];
					}

					$sql = '';
					$params = [];
					if(!empty($vars['get'])) {
						switch($vars['get']) {
							case 'archive':
								$sql = "SELECT
											DATE_FORMAT(publication_date, '%M %Y') AS date,
											count(0) AS count
										FROM blogs
										GROUP BY date";
								break;
							case 'latest':
							default: 
								$sql = "SELECT * FROM blogs
										${id}
										ORDER BY publication_date ${order}
										LIMIT ${num}";
						}
					}

					if(empty($sql)) return '';

					$blog = new blog();
					$blogs = $blog->select($sql, $params);

					$index = 0;
					$output = '';
					foreach ($blogs as $key => $blog) {
						if($vars['get'] == 'latest') {
							$pub = date_create($blog['publication_date']);
							$pub = date_format($pub, $date_format);
							$blog['publication_date'] = $pub;
							$blog['link'] = "/newsroom/${blog['id']}/${blog['slug']}";

							if(!$hide_after 
							|| ($hide_after && $index < $hide_after)) {
								$output .= "<div class='blog-item'>";
							}
							else {
								$output .= "<div class='blog-item hide'>";
							}

							$output .= $fn(array_merge($blog, $_this));
							$output .= "</div>";
						}

						if($vars['get'] == 'archive') {
							$output .= "<div class='blog-item'>";
							$output .= $fn(array_merge($blog, $_this));
							$output .= "</div>";
						}
						$index++;
					}

					return $output;
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
