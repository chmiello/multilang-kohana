<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Internationalization (i18n) class. Provides language loading and translation
 * methods without dependencies on [gettext](http://php.net/gettext).
 *
 * Typically this class would never be used directly, but used via the __()
 * function, which loads the message and replaces parameters:
 *
 *     // Display a translated message
 *     echo __('Hello, world');
 *
 *     // With parameter replacement
 *     echo __('Hello, :user', array(':user' => $username));
 *
 * @package    Kohana
 * @category   Base
 * @author     Kohana Team
 * @copyright  (c) 2008-2011 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Multilang_I18n extends Kohana_I18n{

	static public function user_language()
	{
		foreach(Request::accept_lang() as $lang => $quality)
		{
			// Return the first language found
			return $lang;
		}
		
		return false;
	}
	
	static public function language()
	{
		$lang = Request::factory(Request::detect_uri()) -> param('lang');
		$default = Kohana::$config->load('multilang.default');
		
		// jeżeli istnieje <lang> i lang jest językiem zgodym z ustawieniami
		if($lang and Multilang::acceptLangs($lang))
		{
			$string = $lang;
		}
		// nie istnieje lang bądź jest niezgody z wytycznymi
		else 
		{
			// szukanie langa w uri (jeżeli parametr lang nie ma wartości bądź wartość jest błędna)
			$uri = Request::detect_uri();
			$uri = explode('/',$uri);
			$lang = end($uri);
			if(Multilang::acceptLangs($lang))
			{
				// odnaleziony w uri język jest poprawyny
				$string = $lang;
			}
			else
			{
				//sprawdzenie języka usera
				$lang = I18n::user_language();
				if(Multilang::acceptLangs($lang))
				{
					$string = $lang;
				}
				else
				{
					$string = $default;
				}
			}
		}
		
		return $string;
	}
	
	public static function is_language($string)
	{
		$status = FALSE;
		foreach(Multilang::langs() as $lang)
		{
			if(eregi('/'.$lang,$string))
			{
				$status = TRUE;
			}
		}
		return $status;
	}
	
} // End I18n

