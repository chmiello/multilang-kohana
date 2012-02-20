<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index()
	{
		//I18n::user_language()
		$this->response->body(__('default.welcome.index.start').' <br /> Obecnie używany język : '.I18n::language());
	}

} // End Welcome
