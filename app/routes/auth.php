<?php

namespace puffin;

$app->controller('auth')
	->get( '/auth/', 'index' )
	->get( '/auth/index', 'index' )
	->get( '/auth/login/', 'login' )
	->post( '/auth/login/', 'process_login' )
	->get( '/auth/logout/', 'logout' )
	->get( '/auth/change-password/', 'change_password' )
	->post( '/auth/change-password/', 'process_change_password' )
	->get( '/auth/password-reset/', 'password_reset' )
	->post( '/auth/password-reset/', 'process_password_reset' );
