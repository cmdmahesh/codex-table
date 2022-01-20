<?php

namespace codex\table\controller\admin;
/**
 * 	A class to handle the admin's requests,
 * 	-- enque the admin assets for redering the panels
 * 	-- add entry to the admin panel
 */



defined( 'ABSPATH' ) || exit;



class Admin extends \codex\table\controller\Controller {

	private static $_instance = null;

	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self;
		}

		return self::$_instance;
	}

	private function __construct() {
		
	}

	public function get_categories($parent = 0, $prefix = '') {

		$categories = get_categories(['taxonomy'=>'product_cat','parent'=>$parent]);

		$formated_categories = array();

		if(!empty($categories) and is_array($categories)) {
			foreach($categories as $category) {
				$formated_categories[] = array('key'=>$category->term_id, 'label'=>$prefix.' '.$category->name);
				$formated_categories = array_merge($formated_categories,$this->get_categories($category->term_id,$prefix.'-'));
			}
		}
		return $formated_categories;
	}

	public function get_attributes( ) {
		$taxonomies = wc_get_attribute_taxonomies();

		$formated_taxonomies = array();
		if(!empty($taxonomies) and is_array($taxonomies)) {
			foreach($taxonomies as $taxonomie) {
				$formated_taxonomies[] = array('key'=>$taxonomie->attribute_name,'label'=>$taxonomie->attribute_label);
			}
		}
		return $formated_taxonomies;
	}

	protected function enqueue_assets() {
		$attributes = $this->get_attributes();
		$categories = $this->get_categories();
		
		//add the react support
		\wp_enqueue_style('codex-table-admin-reac',
			constant('CODEX_TABLE_URL').'asset/react/admin/build/index.css',
		);

	 	\wp_enqueue_script(
	    	'codex-table-admin-react',		    	
	    	constant('CODEX_TABLE_URL').'asset/react/admin/build/index.js',
	    	['wp-element'],
	    	time(),// Change this to null for production
	    	true
	  	);
	  	//add the routing data to the react handler
        \wp_add_inline_script( 'codex-table-admin-react', 'const codex_table_data = ' . json_encode( array(
            'ajax_url' => \admin_url( 'admin-ajax.php' ),
			'_categories'=>$categories,
			'_attributes'=>$attributes,
        ) ), 'before' );
	}

	public function add_menu() {
		\add_menu_page(
            __( 'Product Table', 'codex-table' ),
            __( 'Product Table', 'codex-table' ),
            'manage_options',
            'codex-table',
            array($this,'admin_page'),
            'dashicons-editor-table',
            10
        );
	}

	public function admin_page() {		
		$this->enqueue_assets();		
		?><div id="codex-table-container"></div><?php
	}

	public function init() {		
		\add_action('init',function(){
			\add_action( 'admin_menu', array($this,'add_menu'));
		});
    } 	
}

