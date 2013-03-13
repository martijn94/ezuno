<?php
class Logout_Controller extends Base_Controller
{


	public function action_index()
	{
		Session::forget('oneauth');
		return View::Make('login.index');
	}
}