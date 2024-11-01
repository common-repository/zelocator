<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
interface ZL1_ServiceAreas_Query_
{
	public function findById( $id );
	public function findActive();
}

class ZL1_ServiceAreas_Query implements ZL1_ServiceAreas_Query_
{
	protected $txType = 'zl1_servicearea';
	protected $locationPostType = 'zl1_location';

	public function findById( $id )
	{
		$return = array();

		$txQuery = array(
			'taxonomy'		=> $this->txType,
			'hide_empty'	=> FALSE,
			'include'		=> $id
			);
		$terms = get_terms( $txQuery );

		if( $terms ){
			$term = array_shift( $terms );
			$return = $this->_make( $term->term_id, $term->name );
		}

		return $return;
	}

	public function findActive()
	{
		$return = array();

		$txQuery = array(
			'taxonomy'		=> $this->txType,
			'hide_empty'	=> FALSE,
			// 'hide_empty'	=> TRUE,
			);
		$terms = get_terms( $txQuery );

// _print_r( $terms );
		foreach( $terms as $term ){
			$thisOne = $this->_make( $term->term_id, $term->name );
			$return[] = $thisOne;
		}

		return $return;
	}

	protected function _make( $id, $title )
	{
		$return = new ZL1_ServiceAreas_Model( $id, $title );
		return $return;
	}
}
