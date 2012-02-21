<?php
/**
 * The default route
 * It's a bit tricky and particular since it got no translations.
 * We need to create a general route for this one
 *
 * It is recommended to move this route into your bootstrap and adapt it.
 */


Route::set('only.lang','', array('lang' => '('.implode('|',Multilang::langs()).')'))
	-> defaults(array(
		'controller' => 'welcome',
		'action' => 'index',
		'lang' => Kohana::$config->load('multilang.default'),
	));
	
Route::set('test', 'profil/login(/<id>)')
	-> defaults(array(
		'controller' => 'welcome',
		'action' => 'index',
	));
