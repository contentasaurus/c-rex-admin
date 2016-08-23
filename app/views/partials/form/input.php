<?php

$type = $this->tag['type'];

switch( $type )
{
	case 'text':
	case 'color':
	case 'date':
	case 'datetime':
	case 'datetime-local':
	case 'email':
	case 'month':
	case 'number':
	case 'range':
	case 'search':
	case 'tel':
	case 'time':
	case 'url':
	case 'week':
		echo $this->partial('form/input/basic', [ 'tag' => $this->tag ] );
		break;
	case 'checkbox':
	case 'radio':
		echo $this->partial('form/input/checkbox_radio', [ 'tag' => $this->tag ] );
		break;
	default:
		echo $this->partial("form/input/basic", [ 'tag' => $this->tag ] );
		break;
}
