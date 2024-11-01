<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ZL1_Locations_Boot
{
	public function __construct( HC3_Dic $dic )
	{
		$translate = $dic->make('HC3_Translate');

		$labels = array(
			'menu_name'		=> 'Zelocator',
			'name'			=> '__Locations__',
			'singular_name'	=> '__Location__',
			'not_found'		=> '__No Locations Found__',
			'new_item'		=> '__New Location__',
			'add_new' 		=> '__Add New Location__',
			'add_new_item'	=> '__Add New Location__',
			'edit_item'		=> '__Edit__',
			'all_items'		=> '__Locations__',
			'search_items'	=> '__Search__',
			'view_item'		=> '__View__',
			);

		// $page = add_menu_page(
		// 	'Zelocator',
		// 	'Zelocator',
		// 	'read',
		// 	$mainMenuSlug,
		// 	array($this, 'render'),
		// 	'',
		// 	30
		// 	);

		foreach( array_keys($labels) as $k ){
			$labels[$k] = $translate->translate( $labels[$k] );
		}

		register_post_type( 'zl1_location',
			array(
				'labels' => $labels,
				'public' => true,
				'has_archive' => false,
				'exclude_from_search' => true,
				'show_ui'			=> TRUE,
				'show_in_menu'		=> 'zelocator',
				// 'menu_icon'			=> 'dashicons-admin-site',
				// 'menu_icon'			=> 'dashicons-location',
				'menu_icon'			=> 'dashicons-location-alt',

				'rewrite'			=> array('slug' => 'zelocation'),

				'capability_type'	=> array('zl1_location','zl1_locations'),
				'map_meta_cap'		=> TRUE,
				)
			);

		$acl = $dic->make('HC3_Acl');
		$acl
			->register( 'get:locations',		array('ZL1_AclChecker_Admin', 'check') )
			->register( 'get:locations/*',	array('ZL1_AclChecker_Admin', 'check') )
			->register( 'post:locations',	array('ZL1_AclChecker_Admin', 'check') )
			->register( 'post:locations/*',	array('ZL1_AclChecker_Admin', 'check') )
			;

	// flush permalinks if not already done so
		$t = $dic->make('HC3_Time');
		$settings = $dic->make('HC3_Settings');
		$permalinksFlushed = $settings->get('permalinks_flushed');
		if( ! $permalinksFlushed ){
			flush_rewrite_rules();
			$now = $t->formatDateTimeDb();
			$settings->set('permalinks_flushed', $now);
		}
	}
}