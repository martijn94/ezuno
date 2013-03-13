<?php

class Education extends Eloquent
{
    public static $timestamps = false;

    public static $rules = array(
        'name' => 'required'
    );

    public $columns = array(
        'id',
        'name' => array(
            'title' => 'Name',
        )
    );

    public $filters = array(
        'id',
        'name' => array(
            'title' => 'Name',
        ),
    );

    public $edit = array(
        'id',
        'name' => array(
            'title' => 'Name',
            'type' => 'text',
        ),
    );

    public function gebruiker() {
        $this->has_many('Gebruiker');
    }

}