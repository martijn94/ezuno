<?php

class Callback_Controller extends Base_Controller
{
    public function action_oauth2()
    {
        print_r($_GET);
        return Request::uri();
    }

    public function action_index()
    {
        $f = file_get_contents('https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=4/A5Zql79gsH_uoaeFAEh6SMbAuZaZ.4h5RopN_8-cSOl05ti8ZT3apaZkydwI');
        print_r($f);
    }
}