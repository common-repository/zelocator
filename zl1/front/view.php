<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ZL1_Front_View
{
	public function __construct(
		HC3_Hooks $hooks,
		HC3_Ui $ui,
		HC3_Request $request,

		ZL1_Locations_Query $locations,
		ZL1_ServiceAreas_Query $serviceAreas
	)
	{
		$this->request = $request;

		$this->ui = $ui;
		$this->locations = $hooks->wrap($locations);
		$this->serviceAreas = $hooks->wrap($serviceAreas);
	}

	public function render()
	{
		$out = array();

		$serviceAreas = $this->serviceAreas->findActive();

		$serviceAreasOptions = array();
		$serviceAreasOptions[0] = ' - __Select__ - ';
		foreach( $serviceAreas as $e ){
			$locations = $this->locations->findByServiceArea( $e );

			if( ! $locations ){
				continue;
			}

			$serviceAreasOptions[ $e->getId() ] = $e->getTitle();
		}

		$out[] = $this->ui->makeForm(
			'front',
			$this->ui->makeListInline()
				->add( $this->ui->makeInputSelect('servicearea', NULL, $serviceAreasOptions) )
				->add( $this->ui->makeInputSubmit('&rarr;') )
				// ->gutter(0)
			);

		$params = $this->request->getParams();
		if( isset($params['servicearea']) ){
			$locations = $this->locations->findByServiceArea( $params['servicearea'] );
			foreach( $locations as $location ){
				$out[] = $this->renderLocation( $location );
			}
		}

		$out = $this->ui->makeList( $out );
		return $out;
	}

	public function renderLocation( $location )
	{
		$title = $location->getTitle();
		$to = get_permalink( $location->getId() );
		$out = '<a href="' . $to . '">' . $title . '</a>';
		return $out;
	}
}