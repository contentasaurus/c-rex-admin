<?php
namespace puffin\transformer;

// Implementation of https://code.google.com/archive/p/php-slugs/

class safeslug
{
	private $roles = [];

	public function __construct(){}

	public function safeslug( $string, $to_lowercase = false )
	{
		if( !$this->check_slug($string) )
		{
			return $this->make_slug($string);
		}

		if( $to_lowercase )
		{
			$string = strtolower($string);
		}

		return $string;
	}

	protected function no_diacritics($string)
	{
		//cyrylic transcription
		$cyrylic_from = [
			'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л',
			'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш',
			'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е',
			'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с',
			'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю',
			'я'
		];

		$cyrylic_to = [
			'A', 'B', 'W', 'G', 'D', 'Ie', 'Io', 'Z', 'Z', 'I', 'J', 'K', 'L',
			'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Ch', 'C', 'Tch', 'Sh',
			'Shtch', '', 'Y', '', 'E', 'Iu', 'Ia', 'a', 'b', 'w', 'g', 'd',
			'ie', 'io', 'z', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r',
			's', 't', 'u', 'f', 'ch', 'c', 'tch', 'sh', 'shtch', '', 'y', '',
			'e', 'iu', 'ia'
		];

		$from = [
			'Á', 'À', 'Â', 'Ä', 'A', 'A', 'Ã', 'Å', 'A', 'Æ', 'C', 'C', 'C',
			'C', 'Ç', 'D', 'Ð', 'Ð', 'É', 'È', 'E', 'Ê', 'Ë', 'E', 'E', 'E',
			'?', 'G', 'G', 'G', 'G', 'á', 'à', 'â', 'ä', 'a', 'a', 'ã', 'å',
			'a', 'æ', 'c', 'c', 'c', 'c', 'ç', 'd', 'd', 'ð', 'é', 'è', 'e',
			'ê', 'ë', 'e', 'e', 'e', '?', 'g', 'g', 'g', 'g', 'H', 'H', 'I',
			'Í', 'Ì', 'I', 'Î', 'Ï', 'I', 'I', '?', 'J', 'K', 'L', 'L', 'N',
			'N', 'Ñ', 'N', 'Ó', 'Ò', 'Ô', 'Ö', 'Õ', 'O', 'Ø', 'O', 'Œ', 'h',
			'h', 'i', 'í', 'ì', 'i', 'î', 'ï', 'i', 'i', '?', 'j', 'k', 'l',
			'l', 'n', 'n', 'ñ', 'n', 'ó', 'ò', 'ô', 'ö', 'õ', 'o', 'ø', 'o',
			'œ', 'R', 'R', 'S', 'S', 'Š', 'S', 'T', 'T', 'Þ', 'Ú', 'Ù', 'Û',
			'Ü', 'U', 'U', 'U', 'U', 'U', 'U', 'W', 'Ý', 'Y', 'Ÿ', 'Z', 'Z',
			'Ž', 'r', 'r', 's', 's', 'š', 's', 'ß', 't', 't', 'þ', 'ú', 'ù',
			'û', 'ü', 'u', 'u', 'u', 'u', 'u', 'u', 'w', 'ý', 'y', 'ÿ', 'z',
			'z', 'ž'
		];
		$to = [
			'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'C', 'C',
			'C', 'C', 'D', 'D', 'D', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E',
			'G', 'G', 'G', 'G', 'G', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
			'a', 'ae', 'c', 'c', 'c', 'c', 'c', 'd', 'd', 'd', 'e', 'e', 'e',
			'e', 'e', 'e', 'e', 'e', 'g', 'g', 'g', 'g', 'g', 'H', 'H', 'I',
			'I', 'I', 'I', 'I', 'I', 'I', 'I', 'IJ', 'J', 'K', 'L', 'L', 'N',
			'N', 'N', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'CE', 'h',
			'h', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'ij', 'j', 'k', 'l',
			'l', 'n', 'n', 'n', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
			'o', 'R', 'R', 'S', 'S', 'S', 'S', 'T', 'T', 'T', 'U', 'U', 'U',
			'U', 'U', 'U', 'U', 'U', 'U', 'U', 'W', 'Y', 'Y', 'Y', 'Z', 'Z',
			'Z', 'r', 'r', 's', 's', 's', 's', 'B', 't', 't', 'b', 'u', 'u',
			'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'w', 'y', 'y', 'y', 'z',
			'z', 'z'
		];

		$from = array_merge( $from, $cyrylic_from );
		$to = array_merge( $to, $cyrylic_to );

		return str_replace($from, $to, $string);
	}

	protected function make_slug($string, $maxlen=0)
	{
		$new_string_tab = [];
		$new_string = '';

		$string = strtolower( $this->no_diacritics($string) );

		$string_tab = str_split( $string );

		$numbers = ['0','1','2','3','4','5','6','7','8','9','-'];

		foreach( $string_tab as $letter )
		{
			if( in_array( $letter, range('a', 'z') ) || in_array( $letter, $numbers ) )
			{
				$new_string_tab []= $letter;
			}
			else if( $letter==' ' )
			{
				$new_string_tab []= '-';
			}
		}

		if( count($new_string_tab) )
		{
			$new_string = implode( '', $new_string_tab );

			if($maxlen>0)
			{
				$new_string = substr($new_string, 0, $maxlen);
			}

			$new_string = $this->remove_duplicates('--', '-', $new_string);
		}

		return $new_string;
	}

	protected function check_slug( $slug )
	{
		if( preg_match('/^[a-zA-Z0-9]+[a-zA-Z0-9\-]*$/', $slug) == 1 )
		{
			return true;
		}

		return false;
	}

	protected function remove_duplicates($search, $replace, $subject)
	{
		$i=0;
		do
		{
			$subject = str_replace($search, $replace, $subject);
			$pos = strpos( $subject, $search );

			$i++;
			if($i>100)
			{
				die('remove_duplicates() loop error');
			}

		}
		while($pos!==false);

		return $subject;
	}

}
