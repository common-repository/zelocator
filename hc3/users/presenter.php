<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
interface HC3_Users_IPresenter
{
	public function presentTitle( HC3_Users_Model $user );
}

class HC3_Users_Presenter implements HC3_Users_IPresenter
{
	public function __construct( HC3_Ui $ui )
	{
		$this->ui = $ui;
	}

	public function presentTitleList( HC3_Users_Model $user )
	{
		$username = $user->getUsername();
		$displayName = $user->getDisplayName();
		$email = $user->getEmail();

		$return[] = $this->ui->makeSpan( $username )->styleBold();
		$return[] = $this->ui->makeSpan( $displayName )->styleFontSize( 2 );
		if( $email != $username ){
			$return[] = $this->ui->makeSpan( $email )->styleFontSize( 2 );
		}
		$return = $this->ui->makeList( $return )->gutter(0);

		return $return;
	}

	public function presentTitle( HC3_Users_Model $user )
	{
		$username = $user->getUsername();
		$displayName = $user->getDisplayName();
		$email = $user->getEmail();

		$return[] = $this->ui->makeSpan( $username )->styleBold();
		$return[] = '(' . $displayName . ')';

		$return = $this->ui->makeListInline( $return )->gutter(1);
		return $return;
	}

}