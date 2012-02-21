<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index()
	{
		//I18n::user_language()
		$this->response->body(__('default.welcome.index.start').' <br /> Obecnie używany język : '.I18n::language().'<br />'.HTML::anchor('welcome/test/123','Test').'
			<br /><a href="'.route::url('only.lang',array('lang' => 'pl')).'">PL</a>
			<br /><a href="'.route::url('only.lang',array('lang' => 'en')).'">EN</a>
			<br /><a href="'.route::url('only.lang',array('lang' => 'fr')).'">FR</a>
			<br /><a href="'.route::url('only.lang',array('lang' => 'es')).'">ES</a>
		');
	}
	
	public function action_test()
	{
		$this->response->body(__('default.welcome.index.start').' <br /> Obecnie używany język : '.I18n::language().' 
			<br /><a href="'.route::url('only.lang',array('lang' => 'pl')).'">PL</a>
			<br /><a href="'.route::url('only.lang',array('lang' => 'en')).'">EN</a>
			<br /><a href="'.route::url('only.lang',array('lang' => 'fr')).'">FR</a>
			<br /><a href="'.route::url('only.lang',array('lang' => 'es')).'">ES</a>
		');
	}

} // End Welcome
