<?php
class Login_Controller extends Base_Controller
{

	public function __construct()
    {
        $this->filter('before', 'LoginController');
    }

	public function action_index()
	{
		return View::Make('login.index');
	}
}