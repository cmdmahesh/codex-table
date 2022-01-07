<?php
namespace sp\table\controller\publics;

class Publics {
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
        $this->enqueue_assets();		
		?><div id="sp-table-container"></div><?php        
    }

    protected function enqueue_assets() {
        add_action( 'wp_enqueue_scripts',function(){
            $json_data = json_encode(json_decode(file_get_contents(constant('SP_TABLE_DIR').'/asset/csvjson.json')));
            
            //add the react support

            wp_enqueue_style('sp-table-publics-react',
                constant('SP_TABLE_URL').'asset/react/build/index.css',
            );

            wp_enqueue_script(
                'p-table-publics-react',		    	
                constant('SP_TABLE_URL').'asset/react/build/index.css',
                ['wp-element'],
                time(),// Change this to null for production
                true
            );
            //wp_localize_script( 'sp-table-publics-react', 'sp_table_data', array('data'=>$json_data));
            //add the routing data to the react handler
            wp_add_inline_script( 'p-table-publics-react', "window.sp_table_data = JSON.parse('". ($json_data)."'); window.sp_table_data_columns = JSON.parse('".json_encode(array('Shape'=>'Shape','Polish'=>'Polish','Weight'=>'Carat','TotalDepth'=>'Table','Table'=>'Table','Symmetry'=>'Symmetry'))."')",'before');
        });        
	}
}