<?php

	namespace App\Models\Admin;

	class Page extends \Moloquent {

		protected $collection = 'pages';
		protected $dates = ['published_at', 'events.datetime'];

	}
