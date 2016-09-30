<?php
namespace puffin\transformer;
use forxer\Gravatar\Image as GravatarImage;

class gravatar
{
	public function __construct(){}

	public function gravatar( $email, $force_default = false, $size = 120 )
	{
 		return (new GravatarImage())
			->setSize($size)
			->setDefaultImage( 'blank', $force_default)
			->setMaxRating('g')
			->setExtension('jpg')
			->enableSecure()
			->getUrl($email);

	}
}
