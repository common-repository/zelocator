<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Element_Table extends HC3_Ui_Abstract_Collection
{
	protected $htmlFactory = NULL;
	protected $striped = TRUE;
	protected $bordered = FALSE;
	protected $segments = array();
	protected $labelled = FALSE;
	protected $mobile = FALSE;

	public function __construct( HC3_Ui $htmlFactory, $header = NULL, $rows = array(), $striped = TRUE )
	{
		$this->htmlFactory = $htmlFactory;

		// if( count($rows) < 4 ){
			// $striped = FALSE;
		// }
		$this->striped = $striped;

		$finalRows = array();

		if( NULL === $header ){
			$header = $rows[0];
			foreach( array_keys($header) as $k ){
				$header[$k] = NULL;
			}
		}

		$finalRows[] = $this->htmlFactory->makeCollection($header);
		foreach( $rows as $row ){
			$finalRow = $this->htmlFactory->makeCollection($row);
			$finalRows[] = $finalRow;
		}

		parent::__construct( $finalRows );
	}

	public function setMobile( $set = TRUE )
	{
		$this->mobile = $set;
		return $this;
	}

	public function setBordered( $set = TRUE )
	{
		$this->bordered = $set;
		return $this;
	}

	public function setLabelled( $set = TRUE )
	{
		$this->labelled = $set;
		return $this;
	}

	public function setSegments( array $set )
	{
		$this->segments = $set;
		return $this;
	}

	public function setStriped( $striped = TRUE )
	{
		$this->striped = $striped;
		return $this;
	}

	public function render()
	{
	// header
		$show = array();

		$rows = $this->getChildren();
		$header = array_shift( $rows );
		$header = $header->getChildren();

	// if all null then we don't need header
		$show_header = FALSE;
		foreach( $header as $k => $hv ){
			$hv = '' . $hv;
			$header[$k] = $hv;
			if( strlen($hv) ){
				$show_header = TRUE;
			}
		}

		if( $this->labelled ){
			$width = 'x-' . (count($header) - 1);
			$firstWidth = 'x-x';
		}
		else {
			if( array_key_exists('_id', $header) ){
				$width = 'i-' . (count($header) - 1);
				$firstWidth = 'i-i';
			}
			else {
				$width = '1-' . count($header);
				$firstWidth = $width;
			}
		}

		// header
		if( $show_header ){
			$grid = array();

			$ii = 0;
			foreach( $header as $k => $hv ){
				$cell = NULL;

				$cell = $this->htmlFactory->makeBlock( $hv );

				if( $this->gutter ){
					$cell
						->addAttr('class', 'hc-p' . $this->gutter)
						->addAttr('class', 'hc-px' . $this->gutter . '-xs')
						;
				}
				else {
					$cell
						->addAttr('class', 'hc-my1')
						;
				}

				if( ! $this->mobile ){
					$cell
						->addAttr('class', 'hc-py1-xs')
						->addAttr('class', 'hc-xs-hide')
						;
				}

				$thisWidth = $ii ? $width : $firstWidth;
				$thisMobileWidth = $this->mobile ? $thisWidth : 12;
				$grid[] = array( $cell, $thisWidth, $thisMobileWidth );

				$ii++;
			}

			$tr = $this->htmlFactory->makeGrid( $grid )->gutter(0);
			if( $this->bordered ){
				$tr->setBordered( $this->bordered );
			}
			if( $this->segments ){
				$tr->setSegments( $this->segments );
			}

			if( ! $this->bordered ){
				$tr = $this->htmlFactory->makeBlock($tr)
					->addAttr('class', 'hc-fs4')
					->addAttr('style', 'line-height: 1.5em;')
					->addAttr('class', 'hc-border-bottom')
					;

				if( ! $this->mobile ){
					$tr
						->addAttr('class', 'hc-xs-hide')
						;
				}
			}

			if( $this->striped ){
				if( defined('WPINC') ){
					$tr->addAttr('class', 'hc-bg-white');
				}
			}

			$tr = $tr->render();

			if( ! $this->mobile ){
				if( is_object($tr) && method_exists($tr, 'addAttr') ){
					$tr->addAttr('class', 'hc-xs-hide');
				}
			}

			$show[] = $tr;
		}

	// rows
		$rri = 0;

		foreach( $rows as $rid => $row ){
			$row = $row->getChildren();

			$rri++;
			$row_cells = array();

			$ii = 0;
			$grid = array();
			reset( $header );
			foreach( $header as $k => $hv ){
				$v = array_key_exists($k, $row) ? $row[$k] : NULL;
				$cell = $this->htmlFactory->makeBlock( $v );

				if( $this->gutter ){
					$cell
						->addAttr('class', 'hc-p' . $this->gutter)
						->addAttr('class', 'hc-px' . $this->gutter . '-xs')
						;
				}

				if( ! $this->mobile ){
					$cell
						->addAttr('class', 'hc-py1-xs')
						;
				}

				if( strlen($hv) ){
					if( ! $this->mobile ){
						$cell_header = $this->htmlFactory->makeBlock($hv)
							->addAttr('class', 'hc-fs1')
							->addAttr('class', 'hc-muted2')
							->addAttr('class', 'hc-lg-hide')
							->addAttr('class', 'hc-p1-xs')
							;
						$cell = $this->htmlFactory->makeCollection( array($cell_header, $cell) );
					}
				}

				$thisWidth = $ii ? $width : $firstWidth;
				$thisMobileWidth = $this->mobile ? $thisWidth : 12;
				$grid[] = array( $cell, $thisWidth, $thisMobileWidth );

				$ii++;
			}

			$tr = $this->htmlFactory->makeGrid( $grid )->gutter(0);
			if( $this->bordered ){
				$tr->setBordered( $this->bordered );
			}
			if( $this->segments ){
				$tr->setSegments( $this->segments );
			}

			$adjustColor = NULL;
			if( $this->striped ){
				$tr = $this->htmlFactory->makeBlock( $tr );
				if( defined('WPINC') ){
					if( $rri % 2 ){
						$adjustColor = 'hc-bg-wpsilver';
					}
					else {
						$adjustColor = 'hc-bg-white';
					}
				}
				else {
					if( $rri % 2 ){
						$adjustColor = 'hc-bg-lightsilver';
					}
				}
			}

			if( $adjustColor ){
				$tr->addAttr('class', $adjustColor);
			}

			$show[] = $tr;

		// action row?
			if( isset($row['_action']) ){
				$actionView = $row['_action'];

			// offset with id column
				if( array_key_exists('_id', $header) ){
					$actionGrid = array();
					$actionGrid[] = array( NULL, $firstWidth, 12 );
					$actionGrid[] = array( $actionView, 'i-1', 12 );
					$actionView = $this->htmlFactory->makeGrid( $actionGrid );
				}

				$actionTr = $this->htmlFactory->makeBlock( $actionView );

				$actionTr
					// ->addAttr('class', 'hc-border')
					// ->addAttr('class', 'hc-border-red')
					;

				if( $this->gutter ){
					$actionTr
						->addAttr('class', 'hc-pb' . $this->gutter)
						->addAttr('class', 'hc-px' . $this->gutter)
						// ->addAttr('class', 'hc-pb' . $this->gutter . '-xs')
						;
				}
				if( $adjustColor ){
					$actionTr->addAttr('class', $adjustColor);
				}
				$show[] = $actionTr;
			}
		}

		if( $this->bordered ){
			$out = $this->htmlFactory->makeCollection( $show );
			$out = $this->htmlFactory->makeBlock( $out )
				->addAttr('class', 'hc-table')
				// ->addAttr('style', 'border: red 1px solid;')
				;
		}
		else {
			$out = $this->htmlFactory->makeList( $show )->gutter(0);
			$out = $this->htmlFactory->makeBlock( $out )
				->addAttr('class', 'hc-border')
				;
		}

		return $out;
	}
}