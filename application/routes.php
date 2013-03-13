<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|		Route::get('hello', function()
|		{
|			return 'Hello World!';
|		});
|
| You can even respond to more than one URI:
|
|		Route::post(array('hello', 'world'), function()
|		{
|			return 'Hello World!';
|		});
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|		Route::put('hello/(:any)', function($name)
|		{
|			return "Welcome, $name.";
|		});
|
*/

Route::post('user/login', array('as'=>'user.login', 'uses' => 'user@log_in'));
Route::post('user/register', array('as' => 'user.register', 'uses' => 'user@new'));
Route::post('request/new', array('as' => 'request.new', 'uses' => 'request@new_request'));

Route::get('vragen/stellen', 'vragen@stellen');
Route::post('vragen/stellen', 'vragen@stellen');

Route::get('registreer/activeer/(:any)', 'registreer@activeer');
Route::post('registreer/activeer/(:any)', 'registreer@activeer');

Route::Controller(Controller::Detect());


/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
	return Response::error('404');
});

Event::listen('500', function()
{
	return Response::error('500');
});

/*
|--------------------------------------------------------------------------
| Route Filters
|--------------------------------------------------------------------------
|
| Filters provide a convenient method for attaching functionality to your
| routes. The built-in before and after filters are called before and
| after every request to your application, and you may even create
| other filters that can be attached to individual routes.
|
| Let's walk through an example...
|
| First, define a filter:
|
|		Route::filter('filter', function()
|		{
|			return 'Filtered!';
|		});
|
| Next, attach the filter to a route:
|
|		Router::register('GET /', array('before' => 'filter', function()
|		{
|			return 'Hello World!';
|		}));
|
*/

Route::filter('oath2loggedin', function() {

    if(($user_data = Session::get('oneauth')) !== null) {
        $email = $user_data['info']['email'];
        //Check if user exists in Gebuikers table
        $user_resource = Gebruikers::where('social_uid', '=', $email);
        if($user_resource->count() == 0) {
            return Redirect::to('registreer');
        }

        $user = $user_resource->first();
        if($user->activated != 1) {
            return Redirect::to('registreer');
        }

        if($user->foto != $user_data['info']['image']) {
            $user->foto = $user_data['info']['image'];
            $user->save();
        }
        if($user->google != $user_data['info']['urls']['googleplus']) {
            $user->google = $user_data['info']['urls']['googleplus'];
            $user->save();
        }
    }
    else {
        return Redirect::to('gebruiker/login');
    }
});
Route::filter('oauth2RegisterController', function() {

    $current_route = Laravel\Request::uri();

    if(($user_data = Session::get('oneauth')) !== null) {
        $email = $user_data['info']['email'];
        //Check if user exists in Gebuikers table
        $user_resource = Gebruikers::where('social_uid', '=', $email);

        //User exists
        if($user_resource->count() > 0) {
            $user = $user_resource->first();

            if($user->activated == 0) {
                if(empty($user->code)) {
                    //Code not send yet
                    if($current_route != 'registreer/stap2') {
                        return Laravel\Redirect::to('registreer/stap2');
                    }
                }
                else {
                    //Code send but not activated stap2.2
                    if(substr($current_route, 0, 19)  != 'registreer/activeer') {
                        return Laravel\Redirect::to('registreer/activeer');
                    }
                }
            }
            else {
                //Activated and registered all done
                return Laravel\Redirect::to('/');
            }
        }
        else {
            //User Connected with oauth2 not registered as user
            //Send to registeer/stap1
            if($current_route != 'registreer/stap1') {
                return Laravel\Redirect::to('registreer/stap1');
            }
        }

    }

});

Route::filter('LoginController', function() {
    if(Session::get('oneauth') !== null) {
        return Laravel\Redirect::to('registreer');
    }

});


Route::filter('before', function()
{
	// Do stuff before every request to your application...
});

Route::filter('after', function($response)
{
	// Do stuff after every request to your application...
});

Route::filter('csrf', function()
{
	if (Request::forged()) return Response::error('500');
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('login');
});