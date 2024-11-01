<?php if (! defined('ABSPATH')) exit; // Exit if accessed directly
class HC3_HooksWrapper
{
	private $obj = NULL;
	private $h = NULL;
	private $profiler = NULL;

	private $hookStart = NULL;
	private $noCacheFor = array('hc3_time', 'hc3_ui');
	private $useCache = 2;
	// private $useCache = -1;

	public function __construct( $obj, HC3_IHooks $hooks, HC3_Profiler $profiler = NULL )
	{
		$this->obj = $obj;
		$this->h = $hooks;
		$this->profiler = $profiler;

		$hookStart = get_class($this->obj);
		$hookStart = strtolower( $hookStart );

		if( in_array($hookStart, $this->noCacheFor) ){
			$this->useCache = -1;
		}

		$hookStart = str_replace( '_', '/', $hookStart );
		$this->hookStart = $hookStart;
	}

	public function _getClass()
	{
		return get_class( $this->obj );
	}

	public function __call( $method, $args )
	{
		static $cache = array();

		$return = NULL;

		$method = strtolower( $method );
		$hook = $this->hookStart . '::' . $method;

		$cacheKey = NULL;

		if( $this->useCache > -1 ){
			$countArgs = count( $args );

			if( ($this->useCache >= 0) && (! $countArgs) ){
				$cacheKey = $hook;
			}
			elseif( ($this->useCache >= 1) && (1 == $countArgs) ){
				if( is_scalar($args[0]) ){
					$cacheKey = $hook . ':' . $args[0];
				}
				// elseif( is_object($args[0]) ){
					// $cacheKey = $hook . ':' . spl_object_hash($args[0]);
				// }
				elseif( is_object($args[0]) && method_exists($args[0], 'getId') && ($id = $args[0]->getId()) ){
					$cacheKey = $hook . ':' . $id;
				}
			}
			elseif( ($this->useCache >= 2) && (2 == $countArgs) ){
				if( is_scalar($args[0]) && is_scalar($args[1]) ){
					$cacheKey = $hook . ':' . $args[0] . ':' . $args[1];
				}
			}

			// if( ! $cacheKey ){
				// if( 'sh4/app/acl::checkadmin' == $hook ){
				// 	_print_r( $args );
				// 	exit;
				// }
			// }

			if( $cacheKey && isset($cache[$cacheKey]) ){
				return $cache[ $cacheKey ];
			}
		}

		if( (NULL !== $this->profiler) && defined('HC3_PROFILER') ){
			$this->profiler->markStart( $hook );
		}

		$hookBefore = $hook . '::before';
		$hookAfter = $hook . '::after';

		if( method_exists($this->obj, $method) OR $this->h->exists($hook) OR $this->h->exists($hookAfter) OR $this->h->exists($hookBefore) ){
		// before hook, may alter args or stop execution
			$args = $this->h->apply( $hookBefore, $args );
			if( $args === FALSE ){
				// echo "ESCAPE EXECUTION!";
				// exit;
				return $return;
			}

		// own object method
			$return = NULL;
			if( method_exists($this->obj, $method) ){
				$return = call_user_func_array(
					array($this->obj, $method), $args
					);
			}

		// just listen
			$this->h->apply( $hook, $args );

		// after hook, may alter return value
			$return = $this->h->apply( $hookAfter, $return, $args );

			if( (NULL !== $this->profiler) && defined('HC3_PROFILER') ){
				$this->profiler->markEnd( $hook );
			}

			if( $return === $this->obj ){
				return $this;
			}
			else {
				if( $cacheKey ){
					$cache[ $cacheKey ] = $return;
				}
				return $return;
			}
		}
		else {
			echo 'Undefined method - ' . get_class($this->obj) . '::' . $method;
			exit;
		}
	}
}