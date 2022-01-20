<?php
/**
 * Plugin Name: CodX Table
 * Description: WooCommerce Data Table for category and shop page.
 * Author: Mahesh 
 * Version: 1.0
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: codx
 * Domain Path: /language 
 */

defined( 'ABSPATH' ) || exit;

defined('CODEX_TABLE_DIR') || define('CODEX_TABLE_DIR',__DIR__);
defined('CODEX_TABLE_URL') || define('CODEX_TABLE_URL',plugins_url('/',__FILE__));

class CODEX_Table {

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
		\codex\table\controller\Requests::instance()->init();
	}

	public static function do_activate( $network_wide ) {
		if ( ! current_user_can( 'activate_plugins' ) )
			return;

		$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
		check_admin_referer( "activate-plugin_{$plugin}" );
	}

	public static function do_deactivate( $network_wide ) {
		if ( ! current_user_can( 'activate_plugins' ) )
			return;

		$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
		check_admin_referer( "deactivate-plugin_{$plugin}" );
	}

	public static function do_uninstall( $network_wide ) {
		if ( ! current_user_can( 'activate_plugins' ) )
			return;

		check_admin_referer( 'bulk-plugins' );

		if ( __FILE__ != WP_UNINSTALL_PLUGIN  )
			return;
	}
}


function codex_table() {	
	return CODEX_Table::instance();
}


add_action( 'plugins_loaded',function(){
	if(function_exists('codx')) {
		require_once __DIR__.'/vendor/autoload.php';
		codex_table()->init();
	}
});	

register_activation_hook( __FILE__, 'CODEX_Table::do_activate' );
register_deactivation_hook( __FILE__, 'CODEX_Table::do_deactivate' );
register_uninstall_hook( __FILE__, 'CODEX_Table::do_uninstall' );
