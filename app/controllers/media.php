<?php

  namespace App\Http\Controllers\Admin;

  use App\Models\Admin\Media;

  class MediaController extends BaseController {

    public function index() {
        return \View::make('admin/pages/media/library');
    }

    public function ckeditorUpload() {

      $files = scandir(public_path().'/uploads/');

      if ($_FILES['upload']['size'] > 2000000) {
        return '<strong>Sorry the file is to large to upload!</strong>';
      }

      $files = $this->processImages([], $_FILES);
      $file = '/uploads/'.ltrim($files['newfiles']['upload'], 'thumbnail_');

      $media = new Media;

      $media->file = $file;
      $media->mimeType = mime_content_type(public_path().$file);
      $media->size = filesize(public_path().$file);

      $media->save();

      return '<strong>Uploaded File:</strong> '.$file;
    }

    public function ckeditorBrowse() {
      $files = scandir(public_path().'/uploads/');

      $images = [];

      foreach($files as $file) {

        if (strpos($file, '.') != 0 && strpos($file, 'thumbnail_') === false) {
          $images[] = ["image" => '/uploads/'.$file, "thumb" => '/uploads/'.$file];
        }
      }

      return \Response::json($images);

    }
  }
