<?php
/*
|--------------------------------------------------------------------------
| Logger Config
|--------------------------------------------------------------------------
|
|
*/
return [

    /*
    |--------------------------------------------------------------------------
    | Logger
    |--------------------------------------------------------------------------
    |
    | - enabled : true or false
    | - file : File name for the Http Logger
    | - log_response : true for logging responses
    | - input_safe : Protected fields for Input
    */

    'options' => [
        'enabled'       => true,
        'file'          => storage_path("logs/http.log"),
        'log_response'  => true,
        'input_safe'    => array(
            'password',
            'password_confirmation'
        )
    ]
];