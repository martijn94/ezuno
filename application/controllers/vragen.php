<?php

class Vragen_Controller extends Base_Controller
{
    public $restful = true;

    protected $_session;

    protected $_user;

    public function __construct() {
        $this->filter('before', 'oath2loggedin');

        $this->_session = Session::get('oneauth');

        $email          = $this->_session['info']['email'];
        $user_resource  = Gebruikers::where('social_uid', '=', $email);

        $this->_user    = $user_resource->first();
    }

    public function get_index()
    {
        return View::make('registreer/email_activate')->with('user', $this->_user);

        return "GET:/vragen/index";
    }

    public function get_bekijk($id) {

        $question = Question::where_id($id);
        $count    = $question->count();

        if($count == 0) {
            return Response::error(404);
        }

        $result = $question->first();
        $user = Gebruiker::where_id($result->userid)->first();

        $questions = Question::where("userid", "=", $result->userid);
        $count2     = $questions->count();
        $answered = Question::where("userid_answer", "=", $result->userid);
        $count3     = $answered->count();

        $this->_session = Session::get('oneauth');
        $email          = $this->_session['info']['email'];
        $user_resource  = Gebruikers::where('social_uid', '=', $email);

        $this->_user    = $user_resource->first();

        return View::Make('vragen/bekijk')
            ->with([
                'question' => $result,
                'user'     => $user,
                'amount'   => $count2,
                'answered' => $count3,
                'current_user' => $this->_user,
                'current_answer' => $result->answered,
            ]);
    }
    public function post_bekijk($id){

        $question = Question::where_id($id);
        $count    = $question->count();

        if($count == 0) {
            return Response::error(404);
        }

        $result = $question->first();
        $user = Gebruiker::where_id($result->userid)->first();

        $questions = Question::where("userid", "=", $result->userid);
        $count2     = $questions->count();
        $answered = Question::where("userid_answer", "=", $result->userid);
        $count3     = $answered->count();

        $this->_session = Session::get('oneauth');
        $email          = $this->_session['info']['email'];
        $user_resource  = Gebruikers::where('social_uid', '=', $email);

        $this->_user    = $user_resource->first();

        $result->answered = 1;
        $result->save();

         return View::Make('vragen/bekijk')
            ->with([
                'question' => $result,
                'user'     => $user,
                'amount'   => $count2,
                'answered' => $count3,
                'current_user' => $this->_user,
                'alert'      => true,
                'current_answer' => $result->answered,
            ]);

    }

    public function get_overzicht()
    {

        $inputs = Input::all();

        if(isset($inputs['date'], $inputs['keywords'])) {
           $date     = in_array($inputs['date'], ['desc', 'asc'])? $inputs['date'] : 'desc' ;
           $keywords = e($inputs['keywords']);
        }
        else {
            $date     = 'DESC';
            $keywords = null;
        }

        $questions = Question::where('title', 'like', '%'.$keywords.'%')
                    ->where('answered', '=', '0')
                    ->order_by('created_at', strtoupper($date))
                    ->get();

        $education = isset($inputs['studie'])
            && ctype_digit((string)$inputs['studie'])
                ? $inputs['studie']
                : $this->_user->studie;
        $section = isset($inputs['section'])
            && ctype_digit((string)$inputs['section'])
                ? $inputs['section']
                : null;

        $i                = 0;
        $sorted           = [];
        $sorted_questions = [];
        foreach($questions as $question) {

            $points = 0;

            if($education != null || $section != null) {
                if($education != null && $education == $question->education) {
                    $points += 3;
                }

                if($section != null && $section == $question->section) {
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

        foreach($sorted as $key => $value) {
            $sorted_questions[] = $questions[$key];
        }

        return View::Make('vragen/overzicht')->with(array(
            'questions'          => $sorted_questions,
            'educations'         => Education::all(),
            'sections'           => Ezuno\Section::all(),
            'selected_education' => $education,
            'selected_section'   => $section,
        ));
    }

    public function get_stellen()
    {
        //get_class_methods('section');

        return View::Make('vragen/stellen')
            ->with(array(
                'educations' => Education::all(),
                'sections'   => Ezuno\Section::all()
            ));
    }

    public function post_stellen()
    {

        $input = Input::all();
        /* Check if all fields were send through the post request*/
        if(isset($input['section'], $input['studie'], $input['titel'], $input['vraag'], $input['tags'], $input['hidden-tags'])) {
            $title      = e($input['titel']);
            $vraag      = $input['vraag'];
            $tags       = e($input['tags']);
            $hiddentags = e($input['hidden-tags']);
            $section    = e($input['section']);
            $education  = e($input['studie']);

            $rules = array(
                'section'     => 'exists:sections,id',
                'titel'       => 'required|max:150',
                'vraag'       => 'required',
            );


            $messages = array(
                'required' => 'Bovenstaand veld is vereist.',
                'exists'   => 'Maak een keuze',
                'max'      => 'Bovenstaand veld mag niet meer dan 150 karakters bevatten.'
            );

            /* Create validator and check for errors */
            $validation = Validator::make($input, $rules, $messages);
            if($validation->fails()) {

                $messages = $validation->errors->all(':message');

                /* Return a view and show errors to user*/
                return View::Make('vragen/stellen')->with(array(
                    'title'      => $title,
                    'question'   => $vraag,
                    'tags'       => $tags,
                    'hiddentags' => $hiddentags,
                    'messages'   => $messages,
                    'errors'     => $validation->errors,
                    'educations' => Education::all(),
                    'sections'   => Ezuno\Section::all()
                ));
            }
            else {

                $question = new Question;
                $question->userid    = $this->_user->id;
                $question->title     = $title;
                $question->question  = $_POST['vraag'];
                $question->section   = $section;
                $question->education = $education;
                $question->answered  = 0;
                $question->userid_answer = null;
                $question->save();
                //validation success
                header('Refresh: 3; URL=' . Response::make('/vragen/overzicht'));

                return View::make('message.single')->with(array(
                    'title'   => 'Gelukt!',
                    'message' => 'Het is gelukt om je vraag te stellen. <br />
                        Je wordt binnen een aantal seconden doorverwezen.'
                ));
            }
        }
        else {
            return Response::error('500');
        }


    }

}