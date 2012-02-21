<?php
/**
 * The default route
 * It's a bit tricky and particular since it got no translations.
 * We need to create a general route for this one
 *
 * It is recommended to move this route into your bootstrap and adapt it.
 */


Route::set('only.lang','', array('lang' => '('.implode('|',Multilang::factory() -> langs()).')'))
	-> defaults(array(
		'direction' => 'default',
		'controller' => 'index',
		'lang' => Kohana::$config->load('multilang.default'),
	));
	
function __($string, array $values = NULL)
{
	// wyświetlanie ciągu w danym języku
	$string = I18n::get($string,Multilang::factory() -> language());
	return empty($values) ? $string : strtr($string, $values);
}
