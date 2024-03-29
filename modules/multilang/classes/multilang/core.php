<?php defined('SYSPATH') or die('No direct script access.');

class Multilang_Core {

	
	public $config;
	protected static $_instance;
	
	static public function factory()
	{
		if ( ! isset(Multilang::$_instance))
			Multilang::$_instance = new Multilang;

		return Multilang::$_instance;
	} 
	
	public function default_lang()
	{
		return $this->config['default'];
	}
	
	public function __construct()
	{
		$this->config = Kohana::$config->load('multilang');
	}
	
	public function langs()
	{
		// lista pobierana np z DB bądź z pliku config 
		$langs = array();
		foreach($this->config['languages'] as $lang => $name)
		{
			$langs[$lang] = $lang;
		}
		return $langs;
	}
	
	public function all()
	{
		return $this->config['languages'];
	}

	public function acceptLangs($lang)
	{
		$list = Multilang::langs();
		if (in_array($lang,$list))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function user_language()
	{
		foreach(Request::accept_lang() as $lang => $quality)
		{
			// Return the first language found
			return $lang;
		}
 		
		return false;
	}
	
	public function language($uri = null)
	{
		$lang = Request::factory(Request::detect_uri())->param('lang');
		$default = $this->config['default'];
		
		// jeżeli istnieje <lang> i lang jest językiem zgodym z ustawieniami
		if ($lang and Multilang::acceptLangs($lang))
			$string = $lang;
		// nie istnieje lang bądź jest niezgody z wytycznymi
		else 
		{
			// szukanie langa w uri (jeżeli parametr lang nie ma wartości bądź wartość jest błędna)
			$uri = Request::detect_uri();
			$uri = explode('/',$uri);
			$lang = end($uri);
			if (Multilang::acceptLangs($lang))
				// odnaleziony w uri język jest poprawyny
				$string = $lang;
			else
			{
				// sprawdzenie języka usera
				$lang = Multilang::factory()->user_language();
				if(Multilang::acceptLangs($lang))
					$string = $lang;
				else
					$string = $default;
			}
		}
		
		return $string;
	}
	
	public function is_language($string)
	{
		$status = FALSE;
		foreach(Multilang::factory()->langs() as $lang => $name)
		{
			if(preg_match('/\/'. $lang .'/i',$string))
				$status = TRUE;
		}
		return $status;
	}
	
}
