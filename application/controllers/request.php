<?php
class Request_Controller extends Base_Controller {


public function action_new()
	{
		if(!Auth::check()) {
			return View::make('message.single')->with(array(
				'title' => 'Je moet ingelogd zijn om deze pagina te bekijken!',
				'message' => '<br /><a class="btn btn-primary btn-large btn" href="http://ezuno.nl/user/login">Log in</a>'

			));
		}        
		return View::make('request.new');
	}

public function action_index() 
	{

		if(!Auth::check()) {
			return View::make('message.single')->with(array(
				'title' => 'Je moet ingelogd zijn om deze pagina te bekijken!',
				'message' => '<br /><a class="btn btn-primary btn-large btn" href="http://ezuno.nl/user/login">Log in</a>'
			));
		}        
		$requests = Requests::all();
		return View::make('request.index')->with('requests' , $requests);
	}




	public function action_new_request() 
	{	
		
		/* Get all inputs */
		$input = Input::all();

			/* No errors so lets make a new user and attempt to save this */
			$request = new Requests;
			$request->user_id = e(Auth::user()->id);
			$request->title = $input['title'];
			$request->detail = $input['detail'];
			$request->requested_date = $input['datum'];


			
			if($request->save()) {
				header('Refresh: 3; URL=/request');
				return View::make('message.single')->with(array(
					'title' => 'Je request is opgeslagen!',
					'message' => 'Je wordt binnen enkele seconden doorgestuurd!'
				));
			}
		}
	

}