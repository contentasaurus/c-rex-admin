<?php
	$required = '';
	if( $this->tag['required'] ){
		$required = 'required';
	}

	if( empty($this->tag['user_value']) )
	{
		if( isset($this->tag['value']) && !empty($this->tag['value']) )
		{
			$value = $this->tag['value'];
		}
		else if( isset($this->tag['default']) && !empty($this->tag['default']) )
		{
			$value = $this->tag['default'];
		}
		else
		{
			$value = '';
		}
	}
	else
	{
		$value = $this->tag['user_value'];
	}

?>

<input
	type="<?= $this->tag['type'] ?>"
	name="content[<?= $this->tag['repeater_name'] ?>][<?= $this->tag['name'] ?>][]"
	id="content_<?= $this->tag['repeater_name'] ?>_<?= $this->tag['name'] ?>_<?= date('U') ?>"
	class="form-control <?= $required ?>"
	placeholder="<?= @$this->tag['placeholder'] ?>"
	value="<?= $value ?>" <?= $required ?> >
