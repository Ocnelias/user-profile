<?php

/**
 * Configuration file
 */
return array(
    /** Projec Name */
    'project_name' => 'User profile',

    /** User profile base path */
    'base_path' => 'http://user.loc/',

    /** default language */
    'default_language' => 'en',

    /** User profile DB settings */
    'userprofile' => array(
        /** connection settings */
        'driver'   => 'Pdo',
        'dsn'      => 'mysql:host=localhost;dbname=user;charset=utf8',
        'username' => 'root',
        'password' => '2989',
        'options'  => array(
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        ),
    ),

    /** User profile modules */
    'modules' => array(
        'Authorize',
        'Application',
        'User',
    ),
);