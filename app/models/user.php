<?php

  namespace App\Models\Admin;

  use Illuminate\Auth\Authenticatable;
  use Illuminate\Auth\Passwords\CanResetPassword;
  use Illuminate\Foundation\Auth\Access\Authorizable;
  use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
  use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
  use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

  class User extends \Moloquent implements AuthenticatableContract,
                        AuthorizableContract,
                        CanResetPasswordContract
  {
      use Authenticatable, Authorizable, CanResetPassword;

      protected $collection = 'users';
      protected $hidden = ['password', 'remember_token'];
  }
