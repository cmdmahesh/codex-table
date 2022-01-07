<?php

namespace sp\table\controller;
/**
 * 	A class to handle the requests
 * 	-- handle all the incoming requests
 *  -- GET / POST / REQUEST / AJAX 
 */

defined( 'ABSPATH' ) || exit;

class Requests {

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

		if( defined( 'DOING_AJAX' ) or (function_exists('is_ajax') and is_ajax()) ) {
			// ajax request
			\sp\table\controller\ajax\Ajax::instance()->init();

		} elseif(is_admin()) {
			// admin panel request
			\sp\table\controller\admin\Admin::instance()->init();

		} else {
			// public page request
			\sp\table\controller\publics\Publics::instance()->init();

		}

	}
}

