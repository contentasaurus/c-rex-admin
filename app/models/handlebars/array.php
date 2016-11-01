<?php

class handlebars_array implements ArrayAccess
{
	private $data = [];

	public function _construct( $data )
	{
		$this->data = $data;
	}

	public function &__get( $key )
	{
		if( $this->__isset( $key ) )
		{
			return $this->data[$key];
		}
		else
		{
			$value = "<span class=\"background-color:red; color:yellow; padding:3px\">$key does not exist</span>";
			$this->__set( $key, $value );
			return $value;
		}
	}

	public function __set( $key, $value )
	{
		$this->data[$key] = $value;
	}

	public function __isset( $key )
	{
		return isset( $this->data[$key] );
	}

	public function offsetExists($offset){}
	public function offsetSet($offset, $value){}
	public function offsetGet($offset){}
	public function offsetUnset($offset){}

}
