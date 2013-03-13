<?php
class Question extends Eloquent
{
    public static $timestamps = true;

    public $columns = array(
        'id',
        'userid',
        'title',
        'question',
        'tags',
        'section',
        'education',
        'answered',
        'userid_answer' => array(),
        'answered_on',
        'created_at',
        'updated_at',
    );

    public $edit = array(
        'id',
        'userid',
        'title',
        'question' => array(
            'title' => 'vraag',
            'type' => 'wysiwyg',
        ),
        'tags',
        'section',
        'education',
        'answered',
        'userid_answer' => array(),
        'answered_on' => array(
                'type' => 'datetime',
            ),
            'created_at' => array(
                'type' => 'datetime',
            ),
            'updated_at' => array(
                'type' => 'datetime',
            ),
    );
    /*public function __construct()
    {
        $this->edit = $this->columns;
        $this->edit += array(
            'question' => array(
                'type' => 'wysiwyg',
            ),
            'answered_on' => array(
                'type' => 'datetime',
            ),
            'created_at' => array(
                'type' => 'datetime',
            ),
            'updated_at' => array(
                'type' => 'datetime',
            ),
        );
    }*/

    public function search()
    {
        print_r($this->timestamp());;
    }
}