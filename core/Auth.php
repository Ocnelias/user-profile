<?php

namespace Core;

class Auth
{
    /**
    * Sets all needed data to authenticate
    * @param integer $authorizeId
    * @return boolean true
    */
    public function createAuth(int $authorizeId)
    {
        return $this->setAuthSession([
            'authorize_id' => $authorizeId,
        ]);
    }

    /**
     * Removes all session's components
     * @return boolean
     */
    public function deleteAuth()
    {
        return $this->deleteAuthSession();
    }

    /**
     * Returns is user logged in
     * @return boolean
     */
    public static function isLoggedIn()
    {
        return self::getActiveSession();
    }

    /**
     * Returns current authentication session
     * @return string $session
     */
    private static function getActiveSession()
    {
        return (isset($_SESSION['userprofile']['auth']) && $_SESSION['userprofile']['auth']) ? true : false;
    }

    /**
    * Creates a session
    * @param array $session_data data for the session
    * @return boolean
    */
    private function setAuthSession(array $session_data) 
    {
        return $_SESSION['userprofile']['auth'] = $session_data;
    }

    /**
    * Deletes a session
    * @return boolean
    */
    private function deleteAuthSession() 
    {
        unset($_SESSION['userprofile']['auth']);
        return true;
    }
}