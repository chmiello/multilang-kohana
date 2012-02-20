<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Multilang core class
 * From the module https://github.com/GeertDD/kohana-lang
 */

class Multilang_Core {

	public static function acceptLangs($lang)
	{
		// lista langów pobrana z np.DB
		$list = array('pl','en','fr','es');
		if(in_array($lang,$list))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	
}