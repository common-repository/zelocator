<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
interface ZL1_Locations_IQuery
{
	public function findByServiceArea( $serviceArea );
	public function findActive();
}

class ZL1_Locations_Query implements ZL1_Locations_IQuery
{
	protected $txServiceArea = 'zl1_servicearea';
	protected $postType = 'zl1_location';

	public function findByServiceArea( $serviceArea )
	{
		$return = array();
		$serviceAreaId = is_object($serviceArea) ? $serviceArea->getId() : $serviceArea;

		$q = array(
			'orderby'	=> 'post_title',
			'order'		=> 'ASC',
			'post_type'	=> $this->postType,
			'tax_query'	=> array(
				array(
					'taxonomy' => $this->txServiceArea,
					'field' => 'term_id',
					'terms' => $serviceAreaId,
					)
				)
			);

		$wp_query = new WP_Query( $q );
		$posts = $wp_query->get_posts();

		foreach( $posts as $post ){
			$thisOne = $this->_make( $post->ID, $post->post_title );
			$return[] = $thisOne;
		}

		return $return;
	}

	public function findActive()
	{
		$q = array(
			'orderby'	=> 'post_title',
			'order'		=> 'ASC',
			'post_type'	=> $this->postType,
			);

		$wp_query = new WP_Query( $q );
		$posts = $wp_query->get_posts();

		foreach( $posts as $post ){
			$thisOne = $this->_make( $post->ID, $post->post_title );
			$return[] = $thisOne;
		}

		return $return;
	}

	protected function _make( $id, $title )
	{
		$return = new ZL1_Locations_Model( $id, $title );
		return $return;
	}
}
