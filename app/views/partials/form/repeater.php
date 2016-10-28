<?php
	if( isset($this->tag['direction']) )
	{
		if( $this->tag['direction'] == 'horizontal' )
		{
			echo $this->partial("form/repeater_horizontal", [ 'tag' => $this->tag ] );
		}
		else if( $this->tag['direction'] == 'vertical' )
		{
			echo $this->partial("form/repeater_vertical", [ 'tag' => $this->tag ] );
		}
	}
	else
	{
		echo $this->partial("form/repeater_horizontal", [ 'tag' => $this->tag ] );
	}
?>
