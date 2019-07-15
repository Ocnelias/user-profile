<?php

namespace Authorize\Model;

use Application\Model\AuthorizeEntity;

class Authorize extends AuthorizeEntity
{
    /**
     * Login user
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function logIn(string $username, string $password)
    {

        $sql= "SELECT id FROM user WHERE username = :username AND password = :password LIMIT 1";
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ':username'    => $username,
            ':password' => $password
        ));

        return $query->rowcount() ? $query->fetch()->id : false;

    }
}