<?php

namespace sp\table\controller;
/**
 * 	A class to handle the requests
 * 	-- handle all the incoming requests
 *  -- GET / POST / REQUEST / AJAX 
 */

defined( 'ABSPATH' ) || exit;

class Controller {

	private static $_instance = null;

	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	private function __construct() {
		
	}

	public function init() {

	}
}

