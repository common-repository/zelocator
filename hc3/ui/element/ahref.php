<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Element_Ahref extends HC3_Ui_Abstract_Element
{
	protected $uiType = 'ahref';
	protected $to = NULL;

	protected $printVisible = FALSE;

	public function __construct( $to, $label = NULL )
	{
		$this->to = $to;
		if( $label === NULL ){
			$label = $to;
		}
		parent::__construct( 'a', $label );

		$title = strip_tags( $label );
		$this
			->addAttr( 'title', $title )
			;
	}

	public function getTo()
	{
		return $this->to;
	}

	public function newWindow( $set = TRUE )
	{
		$this->addAttr('target', '_blank');
		return $this;
	}

	public function ajax( $set = TRUE )
	{
		$this->addAttr('class', 'hcj2-ajax-loader');
		return $this;
	}

	public function printVisible( $set = TRUE )
	{
		$this->printVisible = $set;
		return $this;
	}

	public function isPrintVisible()
	{
		return $this->printVisible;
	}
}