<?php

use \puffin\model as model;
use \puffin\view as view;
use \puffin\url as url;
use \puffin\transformer as transformer;
use \puffin\file as file;
use \puffin\directory as directory;

#
#	MEDIA SECTION NOT PART OF MVP
#

class img_controller extends puffin\controller\action
{
	public function __construct(){}

	public function __init()
	{
		$this->media = new dam_media();
		$this->tag = new dam_tag();
	}

	public function view_by_dam_media_id( $id )
	{
		$img = $this->media->read( $id );
		$size = $img['size'];
		$mime = $img['mimetype'];
		$this->media->inc_views( $id );
		header("Content-Type: $mime");
		#header("Content-Length: $size");
		ob_clean();
		readfile( PUBLIC_PATH . $img['local_path'] );
		exit;
	}

	public function preview_by_dam_media_id( $id )
	{
		$img = $this->media->read( $id );
		$size = $img['size'];
		$mime = $img['mimetype'];
		header("Content-Type: $mime");
		#header("Content-Length: $size");
		ob_clean();
		readfile( PUBLIC_PATH . $img['local_path'] );
		exit;
	}

	public function view_by_tag( $tag )
	{
		// $img = $this->media->read( $id );
		// $mime = $img['mimetype'];
		// $this->media->inc_views( $id );
		// header("Content-Type: $mime");
		// echo file_get_contents( $img['local_path'] );
		exit;
	}


}
