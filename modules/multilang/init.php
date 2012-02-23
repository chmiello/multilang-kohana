<?php


Route::set('only.lang','', array('lang' => '('.implode('|',Multilang::factory()->langs()).')'))
	-> defaults(array(
		'direction' => 'default',
		'controller' => 'index',
		'lang' => Kohana::$config->load('multilang.default'),
	));
	
function __($string, array $values = NULL)
{
	// wyświetlanie ciągu w danym języku
	$string = I18n::get($string,Multilang::factory()->language());
	return empty($values) ? $string : strtr($string, $values);
}
