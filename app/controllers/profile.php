<?php

  namespace App\Http\Controllers\Admin;

  use App\Models\Admin\User;

    class ProfileController extends BaseController {

    public function index() {
      $data['user'] = User::find(\Auth::user()->id);
      return \View::make('admin.pages.users.profile', $data);
    }

    public function update() {

      if (\Request::ajax()) {
        $user = User::find(\Auth::getUser()->id);

        if (count($_FILES)) {
          $files = $this->processImages($_POST, $_FILES);

          if (count($files['newfiles'])) {
            $_POST = $files['postArray'];
          } else {
            unset($_FILES);
            foreach($files['unset'] as $objectKey) {
              $user->unset($objectKey);
            }
          }
        } else {
          unset($_FILES);
        }

        unset($_POST['_token']);
        unset($_POST['_method']);

        if (empty($_POST['password'])) {
          unset($_POST['password']);
        }

        $keys = array_keys($_POST);

        foreach ($keys as $key) {
          if ($key == 'password') {
            $user->{$key} = \Hash::make($_POST[$key]);
          } else {
            $user->{$key} = $_POST[$key];
          }
        }

        $existingUser = User::where('email', \Input::get('email'))->first();

        if (!is_null($existingUser) && $existingUser->id != \Auth::getUser()->id) {
          return \Response::json(['error' => 'user exists']);
        }

        $user->save();

        if (isset($_FILES)) {
          return \Response::json(['id' => $user['_id'], 'files' => $files['newfiles']]);
        } else {
          return \Response::json(['id' => $user['_id']]);
        }

      } else {
        return \Redirect::route('admin.users.index');
      }

    }

  }
