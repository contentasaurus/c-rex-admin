<?php

use \puffin\file as file;
use \puffin\directory as directory;
use \puffin\model\pdo as pdo;
use \Imagick as imagick;

class dam_media extends pdo
{
	protected $table = 'dam_media';

	public $upload_path = UPLOAD_PATH . '/media';
	public $thumbnail_path = UPLOAD_PATH . '/media/thumbnails';

	public $relative_upload_path = '/uploads/media';
	public $relative_thumbnail_path = '/uploads/media/thumbnails';

	public function get_all( $tags = [], $having = [] )
	{
		$where = '';

		if( !empty($tags) )
		{
			$tag_list = implode(',',$tags);
			$where = "WHERE dmt.tag_id in ($tag_list)";
		}

		$having_str = '';

		if( !empty($having) )
		{
			$having_str = 'HAVING ';
			$having_arr = [];

			$allowed_columns = ['height','width','size','mimetype','views'];
			foreach( $having as $column )
			{
				if( in_array( $column['name'], $allowed_columns ) )
				{
					$name = $column['name'];
					$value = $column['value'];

					switch( $column['compare'] )
					{
						case 'eq': $compare = '='; break;
						case 'neq': $compare = '!='; break;
						case 'lt': $compare = '<'; break;
						case 'lte': $compare = '<='; break;
						case 'gt': $compare = '>'; break;
						case 'gte': $compare = '>='; break;
					}

					$having_arr []= "$name $compare $value";
				}
			}
			$having_str .= implode(' and ', $having_arr);
		}

		$sql = "SELECT
					dm.*,
					group_concat(DISTINCT dt.tagname SEPARATOR '|') AS tags
				FROM dam_media dm
				LEFT JOIN dam_media_tags dmt ON dmt.media_id = dm.id
				LEFT JOIN dam_tags dt ON dt.id = dmt.tag_id
				$where
				GROUP BY dm.id
				$having_str";

		$params = [];

		return $this->select( $sql, $params );
	}


	public function upload_files( $files )
	{
		$this->create_directories();

		$return = [];

		$this->file = new file();

		foreach( $files as $file )
		{
			if( !$file['error'] )
			{
				$this->file->upload( $file, $this->upload_path );
				$image = $this->make_thumbnail( $file['name'] );

				$return []= [
					'remote_uri' => '',
					'local_path' => $this->relative_upload_path . '/' . $file['name'],
					'thumbnail_path' => $image['path'],
					'mimetype' => $image['mime'],
					'size' => $image['size'],
					'width' => $image['width'],
					'height' => $image['height']
				];
			}
		}

		return $return;
	}

	public function transfer_remote_files( $links )
	{
		$return = [];

		foreach( $links as $link )
		{
			$name = pathinfo( parse_url($link,PHP_URL_PATH), PATHINFO_BASENAME );
			$result = file_put_contents( $this->upload_path ."/$name", file_get_contents( $link ) );
			$size = $this->file->get_size( $this->upload_path ."/$name"  );
			$image = $this->make_thumbnail( $name );

			$return []= [
				'remote_uri' => $link,
				'local_path' => $this->relative_upload_path ."/$name",
				'thumbnail_path' => $image['path'],
				'mimetype' => $image['mime'],
				'size' => $image['size'],
				'width' => $image['width'],
				'height' => $image['height']
			];

		}

		return $return;

	}

	public function create_directories()
	{
		$directory = new directory();

		$required_dirs = [
			UPLOAD_PATH,
			$this->upload_path,
			$this->thumbnail_path
		];

		foreach( $required_dirs as $dir )
		{
			if( !$directory->exists( $dir ) )
			{
				$directory->create( $dir );
			}
		}
	}

	public function make_thumbnail( $file, $width = 200 , $height = 200 )
	{
		try
		{
			$imagick = new imagick();
			$imagick->pingImage( $this->upload_path."/$file" );
			$imagick->readImage( $this->upload_path."/$file" );

			$return['size'] = $imagick->getImageLength();
			$return['width'] = $imagick->getImageWidth();
			$return['height'] = $imagick->getImageHeight();
			$return['mime'] = $imagick->getImageMimeType();

			// if( $return['width'] < $width )
			// {
			// 	$width = $return['width'];
			// }
			//
			// if( $return['height'] < $height )
			// {
			// 	$height = $return['height'];
			// }

			$imagick->thumbnailImage( $width, $height, $bestfit = true, $fill = true );
			$imagick->writeImage( $this->thumbnail_path . "/$file" );
			$imagick->destroy();

			$return['path'] = $this->relative_thumbnail_path . "/$file";

			return $return;
		}
		catch(Exception $e)
		{
			print $e->getMessage();
			return $file;
		}
	}

	public function inc_views( $id )
	{
		$table = $this->table;

		$sql = "UPDATE $table
				SET views = views + 1
				WHERE id = :id";
		$params = [
			':id' => $id
		];

		$this->execute( $sql, $params );
	}

}
