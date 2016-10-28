<?php
	$required = '';
	if( $this->tag['required'] ){
		$required = 'required';
	}

	$multiple = '';
	if( isset($this->tag['multiple']) && !empty($this->tag['multiple']) )
	{
		$multiple = 'multiple';
	}
?>

<select
	<?= $multiple ?>
	<?= $required ?>
	name="content[<?= $this->tag['repeater_name'] ?>][<?= $this->tag['name'] ?>][]<?php if(!empty($multiple)):?>[]<?php endif; ?>"
	id="content_<?= $this->tag['name'] ?>_<?= date('U') ?>"
	class="form-control <?= $required ?>">
	<?php foreach( $this->tag['options'] as $key => $option ): ?>
		<?php
			if( isset($this->tag['user_value']) &&
				is_array($this->tag['user_value']) &&
				!empty($this->tag['user_value']) &&
				in_array($option['value'], $this->tag['user_value']) )
			{
				$selected = 'selected="selected"';
			}
			else if( isset($this->tag['user_value']) &&
					!is_array($this->tag['user_value']) &&
					!empty($this->tag['user_value']) &&
					$option['value'] == $this->tag['user_value'] )
			{
				$selected = 'selected="selected"';
			}
			else
			{
				$selected = '';
			}
		?>
		<option <?= $selected ?> value="<?= $option['value'] ?>"><?= $option['label'] ?></option>
	<?php endforeach; ?>
</select>
