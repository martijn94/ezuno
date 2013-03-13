<?php
namespace Ezuno;
class Section extends \Eloquent
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
        'name' => array(
            'title' => 'Name',
            'type' => 'text',
        ),
    );
}