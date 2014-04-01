<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  Component
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

/**
 * Default routing class for missing or legacy component routers
 *
 * @package     Joomla.Libraries
 * @subpackage  Component
 * @since       3.3
 */
class JComponentRouterLegacy extends JComponentRouterBase
{
	/**
	 * Name of the component
	 *
	 * @var    string
	 * @since  3.3
	 */
	protected $component;

	/**
	 * Constructor
	 *
	 * @param   string  $component  Component name without the com_ prefix this router should react upon
	 *
	 * @since   3.3
	 */
	public function __construct($component)
	{
		$this->component = $component;
	}

	/**
	 * Generic build function for missing or legacy component router
	 *
	 * @param   array  &$query  An array of URL arguments
	 *
	 * @return  array  The URL arguments to use to assemble the subsequent URL.
	 *
	 * @since   3.3
	 */
	public function build(&$query)
	{
		$function = $this->component . 'BuildRoute';

		if (function_exists($function))
		{
			$segments = $function($query);

			$segments = $this->encodeSegments($segments);

			return $segments;
		}

		return array();
	}

	/**
	 * Generic parse function for missing or legacy component router
	 *
	 * @param   array  &$segments  The segments of the URL to parse.
	 *
	 * @return  array  The URL attributes to be used by the application.
	 *
	 * @since   3.3
	 */
	public function parse(&$segments)
	{
		$function = $this->component . 'ParseRoute';

		if (function_exists($function))
		{
			$segments = $this->decodeSegments($segments);

			return $function($segments);
		}

		return array();
	}
}
