<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
/**
 *  Bizz Ecommerce Singleton Pattern.
 *
 * @package Bizz Ecommerce Companion
 */

/**
 * Class Bizz_Ecommerce_Singleton
 */
class Bizz_Ecommerce_Singleton{
	/**
	 * Call this method to get singleton
	 */
	public static function instance() {
		static $instance = false;
		if ( $instance === false ) {
			// Late static binding (PHP 5.3+)
			$instance = new static();
		}

		return $instance;
	}

	/**
	 * Make constructor private, so nobody can call "new Class".
	 */
	private function __construct() {}

	/**
	 * Make clone magic method private, so nobody can clone instance.
	 */
	private function __clone() {}

	/**
	 * Make sleep magic method private, so nobody can serialize instance.
	 */
	public function __sleep() {}

	/**
	 * Make wakeup magic method private, so nobody can unserialize instance.
	 */
	public function __wakeup() {}

}
