<?php

$this->tag['name'] = $this->name;

if( !is_null($this->user_value) )
{
	$this->tag['user_value'] = $this->user_value;
}

$tag = '';

switch( $this->tag['type'] )
{
	case 'repeater':
		$tag = $this->partial('form/repeater', [ 'tag' => $this->tag ] );
		break;
	case 'select':
		$tag = $this->partial('form/select', [ 'tag' => $this->tag ] );
		break;
	case 'textarea':
		$tag = $this->partial('form/textarea', [ 'tag' => $this->tag ] );
		break;
	default:
		$tag = $this->partial('form/input', [ 'tag' => $this->tag ] );
		break;
}

?>

<div class="form-group">
	<?= $tag ?>
</div>
