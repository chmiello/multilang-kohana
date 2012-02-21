<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Routes are used to determine the controller and action for a requested URI.
 * Every route generates a regular expression which is used to match a URI
 * and a route. Routes may also contain keys which can be used to set the
 * controller, action, and parameters.
 *
 * Each <key> will be translated to a regular expression using a default
 * regular expression pattern. You can override the default pattern by providing
 * a pattern for the key:
 *
 *     // This route will only match when <id> is a digit
 *     Route::set('user', 'user/<action>/<id>', array('id' => '\d+'));
 *
 *     // This route will match when <path> is anything
 *     Route::set('file', '<path>', array('path' => '.*'));
 *
 * It is also possible to create optional segments by using parentheses in
 * the URI definition:
 *
 *     // This is the standard default route, and no keys are required
 *     Route::set('default', '(<controller>(/<action>(/<id>)))');
 *
 *     // This route only requires the <file> key
 *     Route::set('file', '(<path>/)<file>(.<format>)', array('path' => '.*', 'format' => '\w+'));
 *
 * Routes also provide a way to generate URIs (called "reverse routing"), which
 * makes them an extremely powerful and flexible way to generate internal links.
 *
 * @package    Kohana
 * @category   Base
 * @author     Kohana Team
 * @copyright  (c) 2008-2011 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Multilang_Route extends Kohana_Route {

	public static function url($name, array $params = NULL, $protocol = NULL)
	{
		$route = Route::get($name);
		if(!isset($params['lang'])) { $params['lang'] = I18n::language(); }
		// Create a URI with the route and convert it to a URL
		if ($route->is_external())
		{
			return Route::get($name)->uri($params);
		}
		else
			return URL::site(Route::get($name)->uri($params), $protocol);
	}

	public function __construct($uri = NULL, $regex = NULL)
	{
		if(eregi('>)',$uri)) 
		{
			$uri = str_replace('>)','>(/<lang>))',$uri);
		}
		else if($uri == '')
		{
			$uri = '<lang>';
		}
		else
		{
			$uri .= '(/<lang>)';
		}
		
		if ($uri === NULL)
		{
			// Assume the route is from cache
			return;
		}

		if ( ! is_string($uri) AND is_callable($uri))
		{
			$this->_callback = $uri;
			$this->_uri = $regex;
			$regex = NULL;
		}
		elseif ( ! empty($uri))
		{
			$this->_uri = $uri;
		}

		if ( ! empty($regex))
		{
			$this->_regex = $regex;
		}

		// Store the compiled regex locally
		$this->_route_regex = Route::compile($uri, $regex);
	}

} // End Route
