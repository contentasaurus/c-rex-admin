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

	$large = '';
	if($this->tag['type'] == 'color')
	{
		$large = 'form-control-lg';
	}

?>

<label for="content_<?= $this->tag['name'] ?>"><?= $this->tag['label'] ?></label>
<input type="<?= $this->tag['type'] ?>" name="content[<?= $this->tag['name'] ?>]" id="content_<?= $this->tag['name'] ?>" class="form-control <?= $required ?> <?= $large ?>" placeholder="<?= $this->tag['placeholder'] ?>" value="<?= $value ?>" <?= $required ?> >
