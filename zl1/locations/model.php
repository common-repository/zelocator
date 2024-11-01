<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ZL1_Locations_Model
{
	private $id = NULL;
	private $title = NULL;

	public function __construct( $id, $title )
	{
		$this->id = $id;
		$this->title = $title;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getTitle()
	{
		return $this->title;
	}
}