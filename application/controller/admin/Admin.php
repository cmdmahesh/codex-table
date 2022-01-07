<?php

namespace sp\table\controller\admin;
/**
 * 	A class to handle the admin's requests,
 * 	-- enque the admin assets for redering the panels
 * 	-- add entry to the admin panel
 */



defined( 'ABSPATH' ) || exit;



class Admin extends \sp\table\controller\Controller {

	private static $_instance = null;

	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	private function __construct() {
		
	}

	protected function enqueue_assets() {
		//add the react support

		wp_enqueue_style('sp-table-admin-reac',
			constant('SP_TABLE_URL').'react/build/index.css',
		);

	 	wp_enqueue_script(
	    	'sp-table-admin-react',		    	
	    	constant('SP_TABLE_URL').'react/build/index.js',
	    	['wp-element'],
	    	time(),// Change this to null for production
	    	true
	  	);
	  	//add the routing data to the react handler
        wp_add_inline_script( 'sp-table-admin-react', 'const sp_table_data = ' . json_encode( array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),            
        ) ), 'before' );
	}

	public function add_menu() {
		add_menu_page(
            __( 'Product Table', 'sp-table' ),
            __( 'Product Table', 'sp-table' ),
            'manage_options',
            'sp-table',
            array($this,'admin_page'),
            'dashicons-editor-table',
            10
        );
	}

	public function admin_page() {		
		$this->enqueue_assets();		
		?><div id="sp-table-container"></div><?php
	}

	public function init() {		
		add_action('init',function(){
			add_action( 'admin_menu', array($this,'add_menu'));
		});
    } 	
}

