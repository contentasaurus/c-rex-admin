<?php

use \feather as feather;

class asserts_test extends feather\test
{
	public $x = 0;

	public function __construct(){}

	public function test_assert_array_contains()
	{
		return $this->assert_array_contains( array( 1, 2, 3 ), 2 );
	}

	public function test_assert_array_contains_only_type()
	{
		return $this->assert_array_contains_only_type( 'is_string', array('a','b','c') );
	}

	public function test_assert_array_has_key()
	{
		return $this->assert_array_has_key( array('key'=>1), 'key' );
	}

	public function test_assert_array_not_contains()
	{
		return $this->assert_array_not_contains( array(1,3), 2 );
	}

	public function test_assert_array_size_equals()
	{
		return $this->assert_array_size_equals( array(1,3), 2 );
	}

	public function test_assert_class_has_method()
	{
		return $this->assert_class_has_method( 'asserts_test', 'test_assert_class_has_method' );
	}

	public function test_assert_class_has_property()
	{
		return $this->assert_class_has_property( $this, 'x' );
	}

	public function test_assert_equals()
	{
		return $this->assert_equals( 1, 1 );
	}

	public function test_assert_empty()
	{
		return $this->assert_empty( array() );
	}

	public function test_assert_false()
	{
		return $this->assert_false( false );
	}

	public function test_assert_file_exists()
	{
		return $this->assert_file_exists( TEST_PATH.'/asserts.php' );
	}

	public function test_assert_greater_than()
	{
		return $this->assert_greater_than( 4, 2 );
	}

	public function test_assert_greater_than_or_equal()
	{
		return $this->assert_greater_than_or_equal( 5, 5 );
	}

	public function test_assert_identical()
	{
		return $this->assert_identical( '1', '1' );
	}

	public function test_assert_less_than()
	{
		return $this->assert_less_than( 2, 4 );
	}

	public function test_assert_less_than_or_equal()
	{
		return $this->assert_less_than_or_equal( 2, 2 );
	}

	public function test_assert_not_equals()
	{
		return $this->assert_not_equals( 2, 'banana' );
	}

	public function test_assert_not_empty()
	{
		return $this->assert_not_empty( 42 );
	}

	public function test_assert_not_null()
	{
		return $this->assert_not_null( 42 );
	}

	public function test_assert_null()
	{
		return $this->assert_null( null );
	}

	public function test_assert_preg_match()
	{
		return $this->assert_preg_match( '/^puffin/', 'puffin' );
	}

	public function test_assert_string_ends_with()
	{
		return $this->assert_string_ends_with( 'puffin', 'fin' );
	}

	public function test_assert_string_starts_with()
	{
		return $this->assert_string_starts_with( 'puffin', 'puf' );
	}

	public function test_assert_true()
	{
		return $this->assert_true( true );
	}

	public function test_assert_type()
	{
		return $this->assert_type( 'puffin', 'string' );
	}
}
