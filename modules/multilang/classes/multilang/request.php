<?php defined('SYSPATH') or die('No direct script access.');


class Multilang_Request extends Kohana_Request {

	
	public static function process_uri($uri, $routes = NULL)
	{
		// Load routes
		$routes = (empty($routes)) ? Route::all() : $routes;
		$params = NULL;
		//echo(Multilang::factory()->acceptLangs($uri));
		foreach ($routes as $name => $route)
		{
			// We found something suitable
			if ($params = $route->matches($uri))
			{
				
				if ( ! empty($params['lang']) or Multilang::factory()->acceptLangs($uri) )
					return array(
						'params' => $params,
						'route' => $route,
					);
				else
				{
					// poszukiwaie języka
					foreach($params as $key => $value)
					{
						if (Multilang::factory()->acceptLangs($value) and ($key != 'lang'))
						{
							$lang = $value;
							break;
						}
					}
					if ( ! empty($lang))
					{	
						$params = $route->matches(str_replace(''.$lang,'',$uri));
						$params['lang'] = $lang;
					}
					return array(
						'params' => $params,
						'route' => $route,
					);
					
					
				}
			}
		}

		return NULL;
	}
	
} // End Request
