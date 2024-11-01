<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
interface HC3_Ui_Abstract_Style_
{
	public function styleColor( $color );
	public function styleBgColor( $color );
	public function styleBorderColor( $color );

	public function styleAutoDismiss();

	public function styleBold();
	public function styleUnderline();
	public function styleItalic();
	public function styleLineThrough();

	public function styleFontSize( $size ); // 1-5, 3 default
	public function styleMuted( $level = 2 ); // 1-3
	public function styleHide();
	public function styleNowrap();

	public function styleAlignCenter();
	public function styleAlignLeft();
	public function styleAlignRight();

	public function styleBlock();

	public function styleMargin();
	public function stylePadding();

	public function styleBorder();
	public function styleBorderBottom();
	public function styleBorderTop();

	public function stylePrimaryButton();
	public function styleSecondaryButton();
	public function styleDangerButton();

	public function styleUnstyledLink();
	public function styleBlockLink();
	public function styleDangerLink();
	public function styleActionLink();
	public function styleNiceLink();

	public function styleConfirmAction();
}

abstract class HC3_Ui_Abstract_Style implements HC3_Ui_Abstract_Style_
{
	public function styleColor( $color )
	{
		if( substr($color, 0, 1) == '#' ){
			$this->addAttr('style', 'color: ' . $color . ';');
		}
		else {
			$this->addAttr('class', 'hc-' . $color);
		}

		return $this;
	}

	public function styleBorderColor( $color )
	{
		if( substr($color, 0, 1) == '#' ){
			$this->addAttr('style', 'border-color: ' . $color . ';');
		}
		else {
			$this->addAttr('class', 'hc-border-' . $color);
		}

		return $this;
	}

	public function styleBgColor( $color )
	{
		$this->addAttr('class', 'hc-rounded');

		if( substr($color, 0, 1) == '#' ){
			$this->addAttr('style', 'background-color: ' . $color . ';');
		}
		else {
			$this->addAttr('class', 'hc-bg-' . $color);
		}

		return $this;
	}

	public function styleAutoDismiss()
	{
		$this->addAttr('class', 'hcj2-auto-dismiss');
		return $this;
	}

	public function styleBold()
	{
		$this->addAttr( 'class', 'hc-bold' );
		return $this;
	}

	public function styleUnderline()
	{
		$this->addAttr( 'class', 'hc-underline' );
		return $this;
	}

	public function styleItalic()
	{
		$this->addAttr( 'class', 'hc-italic' );
		return $this;
	}

	public function styleLineThrough()
	{
		$this->addAttr( 'class', 'hc-line-through' );
		return $this;
	}

	public function styleFontSize( $size )
	{
		$this->addAttr( 'class', 'hc-fs' . $size );
		return $this;
	}

	public function styleMuted( $level = 2 )
	{
		$this->addAttr( 'class', 'hc-muted' . $level );
		return $this;
	}

	public function styleHide()
	{
		$this->addAttr( 'class', 'hc-hide' );
		return $this;
	}

	public function styleNowrap()
	{
		$this->addAttr( 'class', 'hc-nowrap' );
		return $this;
	}

	public function styleAlignCenter()
	{
		$this->addAttr( 'class', 'hc-align-center' );
		return $this;
	}

	public function styleAlignLeft()
	{
		$this->addAttr( 'class', 'hc-align-left' );
		return $this;
	}

	public function styleAlignRight()
	{
		$this->addAttr( 'class', 'hc-align-right' );
		return $this;
	}

	public function styleBlock()
	{
		$this->addAttr( 'class', 'hc-block' );
		return $this;
	}

	public function styleMargin()
	{
		$args = func_get_args();
		foreach( $args as $arg ){
			$this->addAttr( 'class', 'hc-m' . $arg );
		}
		return $this;
	}

	public function stylePadding()
	{
		$args = func_get_args();
		foreach( $args as $arg ){
			$this->addAttr( 'class', 'hc-p' . $arg );
		}
		return $this;
	}

	public function styleBorder()
	{
		$this
			->addAttr( 'class', 'hc-border' )
			->addAttr( 'class', 'hc-rounded' )
			;
		return $this;
	}

	public function styleBorderBottom()
	{
		$this->addAttr( 'class', 'hc-border-bottom' );
		return $this;
	}

	public function styleBorderTop()
	{
		$this->addAttr( 'class', 'hc-border-top' );
		return $this;
	}

	public function stylePrimaryButton()
	{
		if( defined('WPINC') ){
			$this
				->addAttr('class', 'button')
				->addAttr('class', 'button-primary')
				->addAttr('class', 'button-large')
				;
		}
		else {
			$this
				->addAttr('class', 'hc-theme-btn-submit')
				->addAttr('class', 'hc-theme-btn-primary')
				;
		}
		return $this;
	}

	public function styleSecondaryButton()
	{
		if( defined('WPINC') && is_admin() ){
			$this
				->addAttr('class', 'page-title-action')
				->addAttr('style', 'top: auto;');
				;
		}
		else {
			$this
				->addAttr('class', 'hc-xs-block')
				->addAttr('class', 'hc-theme-btn-submit')
				->addAttr('class', 'hc-theme-btn-secondary')
				;
		}
		return $this;
	}

	public function styleDangerButton()
	{
		if( defined('WPINC') && is_admin() ){
			$this
				->addAttr('class', 'page-title-action')
				->addAttr('style', 'top: auto;');
				;
		}
		else {
			$this
				->addAttr('class', 'hc-xs-block')
				->addAttr('class', 'hc-theme-btn-submit')
				->addAttr('class', 'hc-theme-btn-secondary')
				;
		}
		return $this;
	}

	public function styleUnstyledLink()
	{
		$this->addAttr('class', 'hc-unstyled-link');
		return $this;
	}

	public function styleBlockLink()
	{
		$this->addAttr('class', 'hc-theme-block-link');
		return $this;
	}

	public function styleDangerLink()
	{
		$this
			->styleActionLink()
			->styleColor( 'darkred' )
			;

		return $this;
	}

	public function styleActionLink()
	{
		$this
			->addAttr('class', 'hc-theme-action-link')
			->styleNowrap()
			;
		return $this;
	}

	public function styleNiceLink()
	{
		$this
			->addAttr('class', 'hc-theme-nice-link')
			->styleNowrap()
			;
		return $this;
	}

	public function styleConfirmAction()
	{
		$this->addAttr('class', 'hcj2-confirm');
		return $this;
	}

}