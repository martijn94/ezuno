<?php
class Gebruiker extends Eloquent
{
	public static $timestamps = true;

    public $columns = array(
        'id',
        'social_uid' => array(
            'title' => 'email',
        ),
        'social_name',
        'studentid',
        'naam',
        'foto',
        'studie',
        'permissions' => array(
            'title' => 'perms',
        ),
        'created_at',
        'updated_at',
        'code',
        'activated' => array(
            'title' => 'active',
            'select' => "IF((:table).activated, 'Yes', 'No')",
        )
    );

    public $filters = array(
        'id',
        'social_uid' => array(
            'title' => 'Email',
        ),
        'naam' => array(
            'title' => 'Naam',
        ),
    );

    public $edit = array(
        'id',
        'social_uid' => array(
            'title' => 'email',
        ),
        'social_name' => array(
            'type' => 'wysiwyg',
        ),
        'studentid',
        'naam',
        'foto',
        'studie',
        'permissions',
        'code',
        'activated' => array(
            'title' => 'active',
        )
    );
}