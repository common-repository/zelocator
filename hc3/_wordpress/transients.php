<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_Transients implements HC3_ITransients
{
	protected $prefix = NULL;
	protected $expire = 3600;

	public function __construct( $prefix )
	{
		$this->prefix = $prefix;
	}

	protected function _wpId( $id )
	{
		$return = $this->prefix . '_' . $id;
		return $return;
	}

	public function set( $value, $name = NULL )
	{
		if( NULL === $name ){
			$conf = array(
				'digits'	=> TRUE,
				'caps'		=> FALSE,
				'letters'	=> FALSE,
				'hex'		=> TRUE,
				);
			$name = HC3_Functions::generateRand( 8, $conf );
		}

		$wpId = $this->_wpId( $name );
		set_transient( $wpId, $value, $this->expire );

		return $name;
	}

	public function reset( $id )
	{
		$wpId = $this->_wpId( $id );
		delete_transient( $wpId );
		return $this;
	}

	public function get( $id )
	{
		$wpId = $this->_wpId( $id );
		$return = get_transient( $wpId );
		return $return;
	}
}