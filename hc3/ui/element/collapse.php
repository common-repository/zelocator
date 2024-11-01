<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
interface HC3_Ui_Element_ICollapse
{
	public function setContent( $content );
	public function border( $border = TRUE );
	public function arrow( $arrow );
	public function expand( $expand = TRUE );
	public function render();
	public function hideToggle( $hide = TRUE );
	public function setTrigger( $trigger );
	public function setArrowUp( $set );
	public function setArrowDown( $set );
}

class HC3_Ui_Element_Collapse extends HC3_Ui_Abstract_Collection implements HC3_Ui_Element_ICollapse
{
	protected $uiType = 'collapse';
	protected $html = NULL;
	protected $label = NULL;
	protected $content = NULL;
	protected $expand = FALSE;
	protected $hideToggle = FALSE;
	protected $trigger = NULL;

	protected $border = FALSE;
	protected $arrow = '&darr;';

	protected $arrowDown = '&darr;';
	protected $arrowUp = '&uarr;';
	protected $arrowWrap = NULL;

	public function __construct( HC3_Ui $html, $label, $content, $expand = FALSE )
	{
		$this->html = $html;
		$this->label = $label;
		$this->content = $content;

		$this->add( $this->label );
		$this->add( $this->content );

		if( $expand ){
			$this->expand();
		}
	}

	public function setArrowUp( $set )
	{
		$this->arrowUp = $set;
		$this->add( $this->arrowUp );
		return $this;
	}

	public function setArrowDown( $set )
	{
		$this->arrowDown = $set;
		$this->add( $this->arrowDown );
		return $this;
	}

	public function setTrigger( $trigger )
	{
		$this->add( $trigger );
		$this->trigger = $trigger;
		return $this;
	}

	public function setContent( $content )
	{
		$this->content = $content;
		return $this;
	}

	public function border( $border = TRUE )
	{
		$this->border = $border;
		return $this;
	}

	public function arrow( $arrow )
	{
		$this->arrow = $arrow;
		return $this;
	}

	public function expand( $expand = TRUE )
	{
		$this->expand = $expand;
		return $this;
	}

	public function hideToggle( $hideToggle = TRUE )
	{
		$this->hideToggle = $hideToggle;
		return $this;
	}

	public function render()
	{
		if( NULL === $this->content ){
			return $this->label;
		}

		$this_id = 'hc3_' . mt_rand( 100000, 999999 );

		$checkbox = $this->html->makeElement('input')
			->addAttr('id', $this_id)
			->addAttr('type', 'checkbox')
			->addAttr('class', 'hc-collapse-toggler')
			->addAttr('class', 'hc-hide')
			;
		if( $this->expand ){
			$checkbox->addAttr('checked', 'checked');
		}

		if( $this->trigger ){
			$trigger = $this->html->makeElement('label', $this->trigger)
				->addAttr('for', $this_id)
				->addAttr('class', 'hc-collapse-burger')
				;
			$trigger = $this->html->makeListInline( array($trigger, $this->label) );
		}
		else {
			$trigger = $this->html->makeElement('label', $this->label)
				->addAttr('for', $this_id)
				->addAttr('class', 'hc-block')
				->addAttr('class', 'hc-collapse-burger')
				->addAttr('class', 'hc-regular')
				;

			if( ! is_object($this->label) ){
				$trigger
					->addAttr('title', strip_tags($this->label) )
					;
			}
		}

		$trigger = $this->html->makeElement('div', $trigger )
			->addAttr('class', 'hc-inline-block')
			->addAttr('class', 'hc-valign-middle')
			;

		if( $this->border ){
			$trigger
				->addAttr('title', strip_tags($this->label) )
				->addAttr('class', 'hc-border-bottom-dotted')
				->addAttr('class', 'hc-border-gray')
				;
		}

		if( (! $this->trigger) && $this->arrow ){
			$arrowUp = $this->html->makeElement('label', $this->arrowUp)
				->addAttr('for', $this_id)
				->addAttr('class', 'hc-collapse-arrow-up')
				->addAttr('class', 'hc-inline-block')
				->addAttr('class', 'hc-valign-middle')
				->addAttr('class', 'hc-mr2')
				;

			$arrowDown = $this->html->makeElement('label', $this->arrowDown)
				->addAttr('for', $this_id)
				->addAttr('class', 'hc-collapse-arrow-down')
				->addAttr('class', 'hc-inline-block')
				->addAttr('class', 'hc-valign-middle')
				->addAttr('class', 'hc-mr2')
				;

			$arrows = $this->html->makeCollection( array($arrowUp, $arrowDown) );
			$trigger = $this->html->makeCollection( array($arrows, $trigger) );
			// $trigger = $this->html->makeListInline( array($arrows, $trigger) )->gutter(1);
		}

		$content = $this->html->makeBlock( $this->content )
			->addAttr('class', 'hc-collapse-content')
			;
		if( ! $this->hideToggle ){
			$content
				->addAttr('class', 'hc-mt1')
				;
		}

		$out = $this->html->makeCollection( array($checkbox, $trigger, $content) );
		$out = $this->html->makeBlock( $out )
 			->addAttr('class', 'hc-collapse-container')
			;

		if( $this->hideToggle ){
			$out
				->addAttr('class', 'hc-collapse-container-hidetoggle')
				;
		}

		return $out;
	}
}