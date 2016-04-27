<?php

	namespace App\Models\Admin;

	class Post extends \Moloquent {

		protected $collection = 'posts';
		protected $dates = ['published_at'];

	}
