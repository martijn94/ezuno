<?php
class Informatie_Controller extends Base_Controller  {

    public function action_overons(){
        return View::make('informatie.overons');

    }

    public function action_help(){
        return View::make('informatie.help');

    }


}