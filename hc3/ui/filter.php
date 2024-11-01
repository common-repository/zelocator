<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Ui_Filter
{
	protected $filters = array();

	public function __construct(
		HC3_Dic $dic,
		HC3_Uri $uri,
		HC3_UriAction $uriAction,
		HC3_Acl $acl,
		HC3_Session $session,
		HC3_Ui $htmlFactory
		)
	{
		$this->filters = array();

		$this->filters['ahref'] = array();
		$this->filters['form'] = array();
		$this->filters['input/submit'] = array();
		$this->filters['collapse'] = array();
		$this->filters['input'] = array();

		$this->filters['ahref'][] = $dic->make('HC3_Ui_Filter_Acl_Ahref');
		$this->filters['form'][] = $dic->make('HC3_Ui_Filter_Acl_Form');
		$this->filters['input/submit'][] = $dic->make('HC3_Ui_Filter_Acl_Submit');

		$this->filters['ahref'][] = $dic->make('HC3_Ui_Filter_Print_Ahref');
		$this->filters['form'][] = $dic->make('HC3_Ui_Filter_Print_Form');
		$this->filters['collapse'][] = $dic->make('HC3_Ui_Filter_Print_Collapse');

		$this->filters['ahref'][] = $dic->make('HC3_Ui_Filter_Uri_Ahref');
		$this->filters['form'][] = $dic->make('HC3_Ui_Filter_Uri_Form');
		$this->filters['input/submit'][] = $dic->make('HC3_Ui_Filter_Uri_Submit');

		$this->filters['input'][] = $dic->make('HC3_Ui_Filter_Input_Fill');
		$this->filters['input'][] = $dic->make('HC3_Ui_Filter_Input_Error');

		$filterUriDataHref = $dic->make('HC3_Ui_Filter_Uri_DataHref');
		$this->filters['input/submit'][] = $filterUriDataHref;
		$this->filters['input/button'][] = $filterUriDataHref;
		$this->filters['aherf'][] = $filterUriDataHref;
	}

	public function filter( $element )
	{
		if( ! is_object($element) ){
			return $element;
		}

		if( method_exists($element, 'getChildren') ){
			$children = $element->getChildren();
			$keys = array_keys($children);
			foreach( $keys as $key ){
				$child = $children[$key];
				$child = $this->filter( $child );
				$element->setChild( $key, $child );
			}
		}

		$uiType = $element->getUiType();
		if( ! $uiType ){
			return $element;
		}

		$myKeys = array();
		$myKeys[] = $uiType;
		if( substr($uiType, 0, 6) == 'input/' ){
			$myKeys[] = 'input';
		}

		reset( $myKeys );
		foreach( $myKeys as $k ){
			if( ! isset($this->filters[$k]) ){
				continue;
			}

			reset( $this->filters[$k] );
			foreach( $this->filters[$k] as $filter ){
				$element = $filter->process( $element );
				if( $element === NULL ){
					break;
				}
			}
		}

		return $element;
	}
}
