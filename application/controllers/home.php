<?php

class Home_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	protected $_session;
	protected $_user;

	public function __construct()
    {
        $this->filter('before', 'oath2loggedin');

        $this->_session = Session::get('oneauth');
        $email          = $this->_session['info']['email'];
        $user_resource  = Gebruikers::where('social_uid', '=', $email);

        $this->_user    = $user_resource->first();
    }


	public function action_index()
	{
		$questions = Question::where("userid", "=", $this->_user->id);
		$count     = $questions->count();

		$answered = Question::where("userid_answer", "=", $this->_user->id);
		$count2     = $answered->count();

		$questions_user = $questions->get();
		array_splice($questions_user, 3);
		/**
		 *
		 * Sorted questions + calc
		 *
		 *
		 */
		$questions = Question::where('answered', '=', '0')
					->where('userid', '!=', $this->_user->id)
                    ->order_by('created_at','DESC')
                    ->get();
        $education = $this->_user->studie;
        if($this->_user->skills != "") {
        $section   = strpos($this->_user->skills, ',') !== false
        					? explode(',', $this->_user->skills)
        					: [0 => $this->_user->skills];
        }
        else {
        	$section = null;
        }

        $i                = 0;
        $sorted           = [];
        $sorted_questions = [];
        foreach($questions as $question) {

            $points = 0;

            if($education != null || $section != null) {
                if($education != null && $education == $question->education) {
                    $points += 3;
                }

                if($section != null && in_array($question->section, $section)) {
                    $points += 2;
                }

                if($points > 0) {
                    $sorted[$i] = $points;
                }
            }
            else {
                $sorted[$i] = $points;
            }

            $i++;
        }

        arsort($sorted);
        array_splice($sorted, 3);

        foreach($sorted as $key => $value) {
            $sorted_questions[] = $questions[$key];
        }

		return View::Make('home/index')->with(array(
			'questions'        => $questions_user,
			'count'            => $count,
			'answered'         => $count2,
			'count3'           => count($sorted_questions),
			'questions_amount' => $questions,
			'sorted_questions' => $sorted_questions,
		));
	}


}