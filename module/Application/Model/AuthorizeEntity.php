<?php

namespace Application\Model;

use Core\SystemModel;

/**
 * Concrete class for Authorize
 * Business layer for Authorize object.
 */
class AuthorizeEntity extends SystemModel
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
     * Email
     * @var string $email
     */
    public $email;
}