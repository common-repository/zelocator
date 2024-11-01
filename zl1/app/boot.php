<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ZL1_App_Boot
{
	public function __construct( HC3_Dic $dic )
	{
		$adminRole = 'zl1_admin';

		add_role(
			$adminRole,
			'Zelocator Administrator',
			array(
				'read' => TRUE,
				'upload_files' => TRUE,
				)
			);

		$capabilities = array(
			'edit_zl1_location',
			'read_zl1_location',
			'delete_zl1_location',
			'edit_zl1_locations',
			'edit_others_zl1_locations',
			'publish_zl1_locations',
			'read_private_zl1_locations',
			'delete_zl1_locations',
			'delete_private_zl1_locations',
			'delete_published_zl1_locations',
			'delete_others_zl1_locations',
			'edit_private_zl1_locations',
			'edit_published_zl1_locations',
		);

		global $wp_roles;
		foreach( $capabilities as $cap ){
			$wp_roles->add_cap( $adminRole, $cap );
			$wp_roles->add_cap( 'editor', $cap );
			$wp_roles->add_cap( 'administrator', $cap );
		}
	}
}