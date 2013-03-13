<?php
class Registreer_Controller extends Base_Controller
{
    protected $_session;

    public function __construct()
    {
        $this->filter('before', 'oauth2RegisterController');

        $this->_session = Session::get('oneauth');
    }

    /**
     * Index function with login button
     */
    public function action_index()
    {
        if($this->_session === null) {
            return View::Make('registreer.index');
        }
        else {
            //Send to stap1 then the filter will pick it up
            return Redirect::to('registreer/stap1');
        }
    }

    public function action_stap1()
    {
        if($this->_session !== null) {
            $email = $this->_session['info']['email'];

            //Check if user exists in Gebuikers table
            $user_resource = Gebruikers::where('social_uid', '=', $email);

            //User exists
            if($user_resource->count() > 0) {
                return Redirect::to('registreer/stap2');
            }

            $gebruiker = new Gebruiker;
            $gebruiker->social_uid      = $this->_session['info']['uid'];
            $gebruiker->social_provider = $this->_session['provider'];
            $gebruiker->social_name     = $this->_session['info']['name'];
            $gebruiker->foto            = $this->_session['info']['image'];
            $gebruiker->google          = $this->_session['info']['urls']['googleplus'];
            $gebruiker->save();

            return View::Make('registreer.stap1');
        }
        else {
            return View::Make('registreer.index');
        }
    }

    public function action_stap2() {
        if($this->_session !== null) {

            $email         = $this->_session['info']['email'];
            $user_resource = Gebruikers::where('social_uid', '=', $email);
            $user          = $user_resource->first();

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $input = Input::all();

                if(isset($input['studnr'], $input['naam'], $input['studie'])) {

                    $studnr = $input['studnr'];
                    $naam   = $input['naam'];
                    $studie = $input['studie'];

                    $rules = array(
                        'studnr' => 'required|numeric|unique:gebruikers,studentid',
                        'naam'   => 'required',
                        'studie' => 'required|exists:educations,id'
                    );

                    $messages = array(
                        'numeric'       => 'Bovenstaand veld kan alleen uit cijfers bestaan.',
                        'studnr_unique' => 'Bovenstaand studenten nummer is al in gebruik',
                        'required'      => 'Bovenstaand veld in vereist.',
                        'studie_exists' => 'De geselecteerde studie is ongeldig.'
                    );

                    /* Create validator and check for errors */
                    $validation = Validator::make($input, $rules, $messages);
                    if($validation->fails()) {

                        $messages = $validation->errors->all(':message');

                        /* Return a view and show errors to user*/
                        return View::Make('registreer/stap2')->with(array(
                            'studnr'     => e($studnr),
                            'naam'       => e($naam),
                            'studie'     => e($studie),
                            'messages'   => $messages,
                            'errors'     => $validation->errors,
                            'educations' => Education::all(),
                            'user'       => $user,
                        ));
                    }
                    else {

                        $user->studentid   = $studnr;
                        $user->naam        = $naam;
                        $user->studie      = $studie; //Educations::find($studie)->first()->name;
                        $user->code        = substr(str_shuffle(implode(range("A", "Z")).implode(range('2', '9')).time()), 0, 15);
                        $user->save();


                        //Send Email
                        try {
                            $mail = IoC::resolve('phpmailer');

                            $mail->Subject    = 'Ezuno Account Verificatie';
                            $mail->Body       = View::Make('registreer/email_activate')
                                                    ->with(array(
                                                        'user' => $user
                                                    ));

                            $mail->SetFrom('ezuno.info@gmail.com');
                            $mail->AddAddress($studnr.'@hr.nl');
                            $mail->AddAddress($email);

                            $mail->isSMTP();
                            $mail->isHTML();

                            $mail->Send();
                        }
                        catch(Exception $e) {
                            echo 'Message was not sent.';
                            echo 'Mailer error: ' . $e->getMessage();
                            return View::Make('message/blank')
                                            ->with(array(
                                                'title'     => 'Email verificatie',
                                                'message'   => 'Er ging iets mis tijdens het versturen van de activatie email',
                                                'goback'    => true,
                                                'blockType' => 'info',
                                                'closeButton' => false
                                            ));
                        }

                        return view::Make('registreer/stap2_done');
                    }
                }
                else {
                    return response::error('500');
                }
            }



            return View::Make('registreer.stap2')
                ->with(array(
                    'educations' => Education::all(),
                    'user' => $user,
                ));
        }
        else {
            return Redirect::to('/registreer/stap1');
        }

    }

    public function action_activeer($code = null) {

        if($this->_session !== null) {

            $email         = $this->_session['info']['email'];
            $user_resource = Gebruikers::where('social_uid', '=', $email);
            $user          = $user_resource->first();


            Validator::register('codeCheck', function($attribute, $value, $parameters) {
                return $parameters[0] == $value;
            });

            if($_SERVER['REQUEST_METHOD'] == 'POST') {

                $input = Input::all();
                if(isset($input['code'])) {
                    $rules = array(
                        'code' => 'required|codeCheck:'.$user->code
                    );

                    $messages = array(
                        'codeCheck' => 'Bovenstaande code was onjuist.'
                    );

                    $validation = Validator::make($input, $rules, $messages);
                    if($validation->fails()) {
                        $messages = $validation->errors->all(':message');

                        return View::Make('registreer/stap3')
                                ->with(array(
                                    'code'   => e($input['code']),
                                    'user'   => $user,
                                    'errors' => $validation->errors
                                ));
                    }

                    $user->code = null;
                    $user->activated = 1;
                    $user->save();

                    return View::Make('message/single')
                                ->with(array(
                                    'title' => 'Account succesvol geactiveerd!',
                                    'message' => '<p class="regtext">Dankjewel voor het activeren van je account je kunt nu aan de slag!</p>'
                                ));
                }
                else {
                    return Response::error('500');
                }
            }

            return View::Make('registreer/stap3')
                        ->with(array(
                            'code' => e($code),
                            'user' => $user
                        ));
        }
    }



}
