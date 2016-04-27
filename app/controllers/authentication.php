<?php

  namespace App\Http\Controllers\Admin;
  use App\Http\Controllers\Controller;

  class AuthController extends Controller {

      public function index () {
          return \View::make('admin.pages.login');
      }

      public function login()
      {
          $validator = \Validator::make(\Input::all(), [
              'email'    => 'required|email',
              'password' => 'required'
          ]);

          if ($validator->fails())
              return \Redirect::route('admin.login')->withErrors($validator)->withInput(\Input::except('password'));

          $user = [
              'email'    => \Input::get('email'),
              'password' => \Input::get('password'),
          ];

          if (\Auth::attempt($user))
              return \Redirect::intended('admin/dashboard');

          \Auth::logout();

          return \Redirect::route('admin.login')->with('error', 'Invalid login! Please try again.')->withInput();
      }


      public function logout()
      {
          \Auth::logout();

          return \Redirect::route('admin.login');
      }

  }
