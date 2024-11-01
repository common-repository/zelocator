<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ZL1_Conf_View
{
	public function __construct( HC3_Ui $ui )
	{
		$this->ui = $ui;
	}

	public function render()
	{
		$out = array();

		$out[] = $this->ui->makeForm(
			'conf/flushpermalinks',
			$this->ui->makeInputSubmit('__Flush Permalinks__')
				->stylePrimaryButton()
			);

		$out = $this->ui->makeList( $out );

		return $out;
	}
}