<?php

	namespace App\Models\Admin;

	class Event extends \Moloquent {

		protected $collection = 'events';
		protected $dates = ['published_at'];

	}
