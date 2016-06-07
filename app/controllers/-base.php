<?php

  namespace App\Http\Controllers\Admin;

  use App\Http\Controllers\Controller;
  use App\Models\Admin\User;
  use Intervention\Image\ImageManagerStatic as Image;

  class BaseController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    protected function getUserList() {
      $users = User::all();
      $usersList = [];

      foreach($users as $user) {
          $usersList[$user->_id] = $user->first_name.' '.$user->last_name;
      }

      return $usersList;
    }

    public function updatePublishDate() {

      $collection = "App\\Models\\Admin\\".$_POST['type'];
      $model = $collection::find($_POST['_id']);
      $model->published_at = new \MongoDB\BSON\UTCDateTime(intval(strtotime($_POST['date'])*1000));
      $model->save();

      exit();
    }

    public function publish() {
      $collection = "App\\Models\\Admin\\".$_POST['type'];

      if (class_exists($collection)) {
        $model = $collection::find($_POST['_id']);
        $model->published_at = new \MongoDB\BSON\UTCDateTime(intval(strtotime('now')*1000));
        $model->save();
      }

      return \Response::json(['_id' => $model->_id, 'type' => $_POST['type'], 'published_at' => date('F j, Y h:i A', strtotime($model->published_at))]);
    }

    public function unpublish() {
      $collection = "App\\Models\\Admin\\".$_POST['type'];

      if (class_exists($collection)) {
        $model = $collection::find($_POST['_id']);
        $model->unset('published_at');
        $model->save();
      }

      return \Response::json(['_id' => $model->_id, 'type' => $_POST['type'], 'published_at' => date('F j, Y h:i A', strtotime($model->published_at))]);
    }

    protected function processImages($postArray, $filesArray) {
    	$newFiles = [];
        $unset = [];
        $imageWidth = 1600;
        $thumbnailWidth = 200;

        if (count($filesArray) > 1) {

          foreach($filesArray as $files) {
            if (is_array($filesArray[key($filesArray)]['name'])) {

              foreach($filesArray[key($filesArray)]['name'] as $index => $file) {
                if (empty($file)) {
                  unset($filesArray[key($filesArray)]['name'][$index]);
                } else {
                  $filename = time().'_'.sanitizedFileName($file);
                  $newFiles[key($filesArray)][$index] = 'thumbnail_'.$filename;
                  $postArray[key($filesArray)][$index] = $filename;

                  // Fullsize Image
                  $image = Image::make($filesArray[key($filesArray)]['tmp_name'][$index])->resize($imageWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                  });

                  $image->save(public_path().'/uploads/'.$filename);

                  // Thumbnail Image
                  $thumbnail = Image::make($filesArray[key($filesArray)]['tmp_name'][$index])->resize($thumbnailWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                  });

                  $thumbnail->save(public_path().'/uploads/thumbnail_'.$filename);

                }
              }

              if (!count($filesArray[key($filesArray)]['name'])) {
                $unset[] = key($filesArray);
              }

            } else {

                if (empty($filesArray[key($filesArray)]['name'])) {
                  $unset[] = key($filesArray);
                } else {
                  $filename = time().'_'.sanitizedFileName($filesArray[key($filesArray)]['name']);
                  $newFiles[key($filesArray)] = 'thumbnail_'.$filename;
                  $postArray[key($filesArray)] = $filename;

                  // Fullsize Image
                  $image = Image::make($filesArray[key($filesArray)]['tmp_name'])->resize($imageWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                  });

                  $image->save(public_path().'/uploads/'.$filename);

                  // Thumbnail Image
                  $thumbnail = Image::make($filesArray[key($filesArray)]['tmp_name'])->resize($thumbnailWidth, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                  });

                  $thumbnail->save(public_path().'/uploads/thumbnail_'.$filename);

                }
            }

            next($filesArray);

          }

        } else {

          if (is_array($filesArray[key($filesArray)]['name'])) {
            foreach($filesArray[key($filesArray)]['name'] as $index => $file) {
              if (empty($file)) {
                unset($filesArray[key($filesArray)]['name'][$index]);
              } else {
                $filename = time().'_'.sanitizedFileName($file);
                $newFiles[key($filesArray)][$index] = 'thumbnail_'.$filename;
                $postArray[key($filesArray)][$index] = $filename;

                // Fullsize Image
                $image = Image::make($filesArray[key($filesArray)]['tmp_name'][$index])->resize($imageWidth, null, function ($constraint) {
                  $constraint->aspectRatio();
                  $constraint->upsize();
                });

                $image->save(public_path().'/uploads/'.$filename);

                // Thumbnail Image
                $thumbnail = Image::make($filesArray[key($filesArray)]['tmp_name'][$index])->resize($thumbnailWidth, null, function ($constraint) {
                  $constraint->aspectRatio();
                  $constraint->upsize();
                });

                $thumbnail->save(public_path().'/uploads/thumbnail_'.$filename);

              }
            }

            if (!count($filesArray[key($filesArray)]['name'])) {
              $unset[] = key($filesArray);
            }
          } else {
            if (empty($filesArray[key($filesArray)]['name'])) {
              $unset[] = key($filesArray);
            } else {
              $filename = time().'_'.sanitizedFileName($filesArray[key($filesArray)]['name']);
              $newFiles[key($filesArray)] = 'thumbnail_'.$filename;
              $postArray[key($filesArray)] = $filename;

              // Fullsize Image
              $image = Image::make($filesArray[key($filesArray)]['tmp_name'])->resize($imageWidth, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
              });

              $image->save(public_path().'/uploads/'.$filename);

              // Thumbnail Image
              $thumbnail = Image::make($filesArray[key($filesArray)]['tmp_name'])->resize($thumbnailWidth, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
              });

              $thumbnail->save(public_path().'/uploads/thumbnail_'.$filename);

            }
          }

        }

    		return ['newfiles' => $newFiles, 'postArray' => $postArray, 'unset' => $unset];
    	}

		public function uploadFiles($filesArray) {
			$storagePath = public_path().'/uploads/attachments/';
	    	$newFiles = [];
	        $unset = [];

			if (!file_exists($storagePath)) {
				mkdir($storagePath);
			}

			foreach($filesArray['files']['name'] as $index => $file) {
				if (!empty($file)) {
					$filename = time().'_'.sanitizedFileName($file);
					move_uploaded_file($filesArray['files']['tmp_name'][$index], $storagePath.$filename);
					$newFiles[$index]['name'] = $filename;
					$newFiles[$index]['mime_type'] = $filesArray['files']['type'][$index];
					$newFiles[$index]['original_name'] = $filesArray['files']['name'][$index];
				}
			}

			return $newFiles;

		}
  }
