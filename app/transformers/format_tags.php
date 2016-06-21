<?php
namespace puffin\transformer;

class format_tags
{
	public function __construct(){}

	// tagname1|tagname2|tagname3
	public function format_tags( $tags )
	{
		$return = '';
		$arr = explode('|', $tags);
		foreach( $arr as $v )
		{
			if( !empty($v) )
			{
				$return .= "<a href='?filters[tag]=$v' class='btn btn-link btn-sm'>$v</a>";
			}
		}
		return $return;
	}
}
