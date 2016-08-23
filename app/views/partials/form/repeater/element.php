<?php

$this->tag['name'] = $this->name;
$this->tag['repeater_name'] = $this->repeater_name;

if( !is_null($this->user_value) )
{
	$this->tag['user_value'] = $this->user_value;
}

$tag = '';

switch( $this->tag['type'] )
{
	case 'repeater':
		#can't nest repeaters right now
		break;
	case 'select':
		echo $this->partial('form/repeater/select', [ 'tag' => $this->tag ] );
		break;
	case 'textarea':
		echo $this->partial('form/repeater/textarea', [ 'tag' => $this->tag ] );
		break;
	default:
		echo $this->partial('form/repeater/input', [ 'tag' => $this->tag ] );
		break;
}
