<?php

namespace Application\Model;

use Core\SystemModel;

/**
 * Concrete class for User
 * Business layer for User object.
 */
class UserEntity extends SystemModel
{
    /**
     * Id
     * @var integer $id
     */
    public $id;

    /**
     * Username
     * @var string $username
     */
    public $username;


    /**
     * Password
     * @var string $password
     */
    public $password;

    /**
     * First name
     * @var string $firstname
     */
    public $firstname;

    /**
     * Last name
     * @var string $password
     */
    public $lastname;

    /**
     * Email
     * @var string $email
     */
    public $email;

    /**
     * Description
     * @var string $description
     */
    public $description;

    /**
     * Imaage file name
     * @var string $image
     */
    public $image;


}