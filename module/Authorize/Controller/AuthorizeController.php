<?php

namespace Authorize\Controller;

use Core\SystemController;
use Authorize\Model\Authorize;
use Core\Auth;

/**
 * Controller for authorization page
 */
class AuthorizeController extends SystemController
{
    /**
     * Index tasks page
     */
    public function indexAction()
    {

        $this->loginAction();
    }

    /**
     * Login  page action
     */
    public function loginAction()
    {

        if (!$this->isAuthorize) {
            if (isset($_POST['username'])) {
                $authorize  = new Authorize($this->config);
                if ($authorizeId = $authorize->logIn($_POST['username'],md5($_POST['password']))) {
                    $auth = new Auth();
                    $auth->createAuth($authorizeId);
                    header('location: ' . $this->config['base_path']);
                } else {
                    $errorMessage = "Incorrect login or password";
                }
            }

            // load views.
            $this->view('authorize/login', [
                'errorMessage' => $errorMessage ?? null
            ]);
        } else {
            header('location: ' . $this->config['base_path']);
        }
    }

    /**
     * Logout  page action
     */
    public function logoutAction()
    {
        if ($this->isAuthorize) {
            $auth = new Auth();
            $auth->deleteAuth();
        }

        header('location: ' . $this->config['base_path']);
    }
}