<?php

  namespace App\Http\Controllers\Admin;

  use App\Models\Admin\User;

  class UsersController extends BaseController {

      public function __construct() {
          $this->middleware('auth.admin');
      }

      public function index() {
          $data['users'] = User::all();
          $data['total'] = User::count();

          return \View::make('admin/pages/users/list', $data);
      }

      public function create() {
          $data['users'] = User::all();

          return \View::make('admin.pages.users.create', $data);
      }

      public function edit($id = null) {
          if (is_null($id))
          {
              return \Redirect::route('admin.users.index');
          }

          $data['user'] = User::find($id);

          return \View::make('admin.pages.users.edit', $data);
      }

      public function store() {
          if (\Request::ajax()) {
            $user = new User;

            if (count($_FILES)) {
      				$files = $this->processImages($_POST, $_FILES);

              if (count($files['newfiles'])) {
                if (isset($files['postArray']['photo'])) {
                  $_POST['photo'] = $files['postArray']['photo'];
                }

              } else {
                unset($_FILES);
                foreach($files['unset'] as $objectKey) {
                  if (isset($user->{$objectKey})) {
                    $user->unset($objectKey);
                  }
                }
              }
            } else {
              unset($_FILES);
            }

            unset($_POST['_token']);

            $keys = array_keys($_POST);

            foreach ($keys as $key) {
                if ($key == 'password') {
                    $user->{$key} = \Hash::make($_POST[$key]);
                } else {
                    $user->{$key} = $_POST[$key];
                }
            }

            $existingUser = User::where('email', \Input::get('email'))->first();

            if (count($existingUser)) {
                return \Response::json(['error' => 'Email address is already in use!']);
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

      public function update($id = null)
      {
          if (\Request::ajax()) {
            $user = User::find($id);

            if (count($_FILES)) {
      				$files = $this->processImages($_POST, $_FILES);

              if (count($files['newfiles'])) {
                if (isset($files['postArray']['photo'])) {
                  $_POST['photo'] = $files['postArray']['photo'];
                }

              } else {
                unset($_FILES);
                foreach($files['unset'] as $objectKey) {
                  if (isset($user->{$objectKey})) {
                    $user->unset($objectKey);
                  }
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

            if (count($existingUser) && $id != $existingUser->id) {
                return \Response::json(['error' => 'Email address is already in use!']);
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

      public function destroy($id = null) {
          if (is_null($id))
          {
              return \Response::json(['msg' => 'Fail!']);
          }

          $user = User::find($id);

          if ($user->email != "it-registrations@paradowski.com") {
            User::destroy($id);
          } else {
            return \Response::json(['msg' => 'Fail!']);
          }

          return \Response::json(['msg' => 'success']);
      }

  }
