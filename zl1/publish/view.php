<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ZL1_Publish_View
{
	public function __construct(
		HC3_Ui $ui,
		HC3_Ui_Layout1 $layout
	)
	{
		$this->ui = $ui;
	}

	public function render()
	{
		$shortcode = 'zelocator';

		$out = array();

		ob_start();
		require( dirname(__FILE__) . '/view.html.php' );
		$shortcodeView = ob_get_contents();
		ob_end_clean();

		$out[] = $shortcodeView;
		$out = $this->ui->makeList( $out );

		$pageIds = HC3_Functions::wpGetIdByShortcode($shortcode);
		if( $pageIds ){
			foreach( $pageIds as $pid ){
				$link = get_permalink( $pid );
				$label = get_the_title( $pid );
				$page = $this->ui->makeAhref( $link, $label )
					->addAttr('target', '_blank')
					;
				$pages[] = $page;
			}
		}
		else {
			$pages[] = '__None__';
		}

		$addNewLink = $this->ui->makeAhref( admin_url('post-new.php'), '__Add New__' )
			->styleSecondaryButton()
			;

		$pages[] = $addNewLink;
		$pages = $this->ui->makeList( $pages );
		$pages = $this->ui->makeLabelled( '__Pages With Shortcode__', $pages );

		$out = $this->ui->makeGrid()
			->add( $out, 8, 12 )
			->add( $pages, 4, 12 )
			;

		$this->layout
			->setContent( $out )
			->setHeader( $this->self->header() )
			;

		$out = $this->layout->render();
		return $out;
	}

	public function header()
	{
		$out = '__Publish__';
		return $out;
	}
}