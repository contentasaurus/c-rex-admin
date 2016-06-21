<?php
namespace puffin\transformer;

class fixfiles
{
	public function __construct(){}

	public function fixfiles( $_files = [] )
	{
		// Reorganize $_FILES array information
		$files = [];
		$i = 0;

		// Start with all inputs in $_FILES array
		foreach( $_files as $input )
		{
			$j = 0;
			foreach ($input as $property => $value)
			{
				if (is_array($value))
				{
					$j = count($value); // Number of iterations
					for ($k = 0; $k < $j; ++$k)
					{
						 $files[$i + $k][$property] = $value[$k];
					}
				}
				else
				{
					$j = 1;
					$files[$i][$property] = $value;
				}
			 }
			 $i += $j;
		}

		return $files;
	}
}
