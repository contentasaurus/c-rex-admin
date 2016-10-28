<?php
	$required = '';
	if( isset($this->tag['required']) )
	{
		$required = 'required';
	}
?>

<?php foreach( $this->tag['options'] as $key => $option ): ?>

	<?php
		if( isset($this->tag['user_value']) && !empty($this->tag['user_value']) && ( in_array($option['value'], $this->tag['user_value']) ) )
		{
			$checked = 'checked';
		}
		else
		{
			$checked = '';
		}
	?>
	<div class="form-check">
		<label for="content_<?= $this->tag['name'] ?>_<?= $option['value'] ?>_<?= date('U') ?>" class="form-check-label" for="content_<?= $this->tag['name'] ?>">
			<input
				type="<?= $this->tag['type'] ?>"
				name="content[<?= $this->tag['repeater_name'] ?>][<?= $this->tag['name'] ?>][][]"
				id="content_<?= $this->tag['name'] ?>_<?= $option['value'] ?>_<?= date('U') ?>"
				class="form-check-input <?= $required ?>"
				value="<?= $option['value'] ?>"
				<?= $checked ?>
				<?= $required ?> >
			<?= $option['label'] ?>
		</label>
	</div>
<?php endforeach ?>
