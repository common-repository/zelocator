<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ZL1_ServiceAreas_Boot
{
	public function __construct( HC3_Dic $dic )
	{
		$translate = $dic->make('HC3_Translate');

		$labels = array(
			'name'				=> '__Service Areas__',
			'singular_name'		=> '__Service Area__',
			'search_items'		=> __('Search Courses'),
			'all_items'			=> '__All Service Areas__',
			// 'parent_item'		=> __('Parent Course'),
			// 'parent_item_colon'	=> __('Parent Course:'),
			'edit_item'			=> '__Edit__',
			'update_item'		=> '__Update__',
			'add_new_item'		=> '__Add New__',
			'new_item_name'		=> '__New Name__',
			'menu_name'			=> '__Service Areas__',
			);

		foreach( array_keys($labels) as $k ){
			$labels[$k] = $translate->translate( $labels[$k] );
		}

		$args = array(
			'hierarchical'		=> TRUE, // make it hierarchical (like categories)
			'labels'			=> $labels,
			// 'show_ui'			=> TRUE,
			// 'show_in_menu'		=> 'zelocator',
			'show_admin_column'	=> TRUE,
			'query_var'			=> TRUE,
			'capabilities'		=> array(
				'manage_terms'	=> 'edit_zl1_locations',
				'edit_terms'	=> 'edit_zl1_locations',
				'delete_terms'	=> 'edit_zl1_locations',
				'assign_terms'	=> 'edit_zl1_locations'
				),
			'rewrite'			=> array('slug' => 'zeservicearea'),
			);

		register_taxonomy( 'zl1_servicearea', 'zl1_location', $args );
		register_taxonomy_for_object_type( 'zl1_servicearea', 'zl1_location' );

		$topmenu = $dic->make('HC3_Ui_Topmenu');
		if( current_user_can('edit_zl1_locations')){
			$topmenu
				->add(
					'serviceareas',
					array('edit-tags.php?taxonomy=zl1_servicearea&post_type=zl1_location', '__Service Areas__')
					)
				;
		}
	}
}