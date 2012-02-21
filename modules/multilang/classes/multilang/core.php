<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Multilang core class
 * From the module https://github.com/GeertDD/kohana-lang
 */

class Multilang_Core {

	public static function langs()
	{
		// lista pobierana np z DB b¹dŸ z pliku config 
		return array('pl','en','fr','es');
	}

	public static function acceptLangs($lang)
	{
		$list = Multilang::langs();
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