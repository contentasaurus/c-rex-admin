<?php

  namespace App\Http\Controllers\Admin;

  class DashboardController extends BaseController {
    
      public function index() {
        return \View::make('admin/pages/dashboard');
      }
  }
