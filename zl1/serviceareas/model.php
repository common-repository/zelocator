<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ZL1_ServiceAreas_Model
{
	private $id = NULL;
	private $title = NULL;
	private $locationsIds = array();

	public function __construct( $id, $title, $locationsIds = array() )
	{
		$this->id = $id;
		$this->title = $title;
		$this->locationsIds = $locationsIds;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getLocationsIds()
	{
		return $this->locationsIds;
	}
}