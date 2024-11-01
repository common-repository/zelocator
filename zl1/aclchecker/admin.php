<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class ZL1_AclChecker_Admin implements HC3_Interface_AclChecker
{
	public function __construct(
		HC3_Auth $auth,
		HC3_Users_Query $users
		)
	{
		$this->auth = $auth;
		$this->users = $users;
	}

	public function check( $slug = NULL )
	{
		$return = FALSE;

		$userId = $this->auth->getCurrentUserId();
		$user = $this->users->findById( $userId );
		if( $user ){
			$return = TRUE;
		}

		return $return;
	}
}