<?php
class Gebruiker_Controller extends Base_Controller
{
	public $restful = true;

	public function __construct()
    {
        $this->filter('before', 'oath2loggedin')->except(array('login'));;

        $this->_session = Session::get('oneauth');
    }

	public function get_index()
	{
		return Redirect::to('/');
	}

	public function get_loguit()
	{
		Session::forget('oneauth');
		return Redirect::to('gebruiker/login');
	}

	public function get_login()
	{

		if(Session::get('oneauth') !== null) {
        return Laravel\Redirect::to('registreer');
    	}
    	else {
			return View::Make('gebruiker/login');
		}

	}

	public function get_bekijk($id)
	{
		//Get Requested user
		$user_resource = Gebruiker::where_id($id)->where('activated', '=', 1);

		if($user_resource->count() == 0) {
			return Response::error(404);
		}

		$user   = $user_resource->first();
		$assign = [
			'user' => $user,
			'type' => 'global',
		];

		//Get Current user
		$email         		= $this->_session['info']['email'];
		$user_self_resource = Gebruikers::where('social_uid', '=', $email);
        $user_self          = $user_self_resource->first();
        if($user->id == $user_self->id) {
        	$assign['type'] = 'self';
        }

		return View::Make('gebruiker.profiel')->with($assign);
	}

	public function get_profiel()
	{
		$email         = $this->_session['info']['email'];
		$user_resource = Gebruikers::where('social_uid', '=', $email);
        $user          = $user_resource->first();
        //$newDate       = date("d-m-Y", strtotime($user->created_at));

		return View::Make('gebruiker/profiel')->with(array(
			"user"    => $user,
			"type"    => 'self',
		));
	}



	public function get_bewerk()
	{

		$email         = $this->_session['info']['email'];
		$user_resource = Gebruikers::where('social_uid', '=', $email);
        $user          = $user_resource->first();

		return View::Make('gebruiker/bewerk')->with(array(
			'user'       => $user,
			'educations' => Education::all(),
			'sections'   => Ezuno\Section::all(),
			'skills'     => explode(',', $user->skills),
		));
	}

	public function post_bewerk()
    {

    	$input         = Input::all();
    	$email         = $this->_session['info']['email'];
		$user_resource = Gebruikers::where('social_uid', '=', $email);
        $user          = $user_resource->first();

		$naam     = $input['naam'];
		$studie	  = $input['studie'];
		$leeftijd = $input['leeftijd'];
		$email    = $input['email'];
		$website  = $input['website'];

		$linkedin = $input['linkedin'];
		$facebook = $input['facebook'];
		$twitter  = $input['twitter'];

		$sections = $input['section'];
		$section  = [];
		foreach($sections as $key => $value) {
			if($value == "on") {
				$section[] = $key;
			}
		}
		$skills = implode(',', $section);

		$user->naam     = $naam;
		$user->studie   = $studie;
		$user->leeftijd = $leeftijd;
		$user->persmail = $email;
		$user->website  = $website;
		$user->skills   = $skills;

		$user->linkedin = $linkedin;
		$user->facebook = $facebook;
		$user->twitter  = $twitter;
        $user->save();

        $email         = $this->_session['info']['email'];
		$user_resource = Gebruikers::where('social_uid', '=', $email);
        $user          = $user_resource->first();
        $newDate = date("d-m-Y", strtotime($user->created_at));


		return View::Make('gebruiker/profiel')->with(array(
			"user"       =>$user,
			"type"       => 'self',
			'educations' => Education::all(),
			'alert'      => true,
		));
    }
}