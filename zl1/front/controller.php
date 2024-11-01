<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ZL1_Front_Controller
{
	public function __construct(
		HC3_Hooks $hooks,
		HC3_Post $post,
		ZL1_Locations_Query $locations,
		ZL1_ServiceAreas_Query $serviceAreas
		)
	{
		$this->post = $post;
		$this->locations = $hooks->wrap($locations);
		$this->serviceAreas = $hooks->wrap($serviceAreas);
	}

	public function execute()
	{
		$post = $this->post->get();

		if( array_key_exists('servicearea', $post) && $post['servicearea'] ){
			$serviceAreaId = $post['servicearea'];
			$serviceArea = $this->serviceAreas->findById( $serviceAreaId );

			$locations = $this->locations->findByServiceArea( $serviceAreaId );
			if( $locations && (count($locations) == 1) ){
				$location = array_shift( $locations );
				$to = get_permalink( $location->getId() );
				wp_redirect( $to );
				exit;
			}

			$params['servicearea'] = $post['servicearea'];
		}

		$to = array( 'front', $params );
		$return = array( $to, NULL );

		return $return;
	}
}